<?php

/**
 * mock implementation of basic database operations
 *
 * to be used in exercises before databases are taught
 *
 * all data is being stored and retrieved in JSON format in a single file data.json which will be created
 * next to the executed script (e.g. index.php)
 * if a different data file location is required, it can be set using the global constant DATA_FILE_LOCATION,
 * e.g. define('DATA_FILE_LOCATION', 'C:\www\some\path\my_data.json');
 *
 * the globally exposed functions that can be used to use this class:
 *
 * $id = insert($data) // inserts one record, returns the id of the new record
 * update($id, $data) // updates one record
 * delete($id) // deletes one record
 * select() // gets records as arrays
 * select(10) // gets first 10 records as arrays
 * select(10, 20) // skips 20 records and gets 10 following records as arrays
 * find($id) // gets one record as array
 *
 * OOP, not found in Laravel:
 * select(10, 0, true) // gets first 10 records as stdClass objects
 * select(10, 0, 'MyClassName') // gets first 10 records as objects of class MyClassName
 * find($id, true) // gets one record as stdClass object
 * find($id, 'MyClassName') // gets one record as object of class MyClassName
 */

class DBBlackbox
{
    protected static $data_file = null; // null === not determined
    protected static $data = null; // null === not loaded

    public static function getDataFile()
    {
        if (static::$data_file === null) {
            if (defined('DATA_FILE_LOCATION')) {
                static::$data_file = DATA_FILE_LOCATION;
            } elseif(!empty($_SERVER['SCRIPT_FILENAME']) && file_exists(dirname($_SERVER['SCRIPT_FILENAME']))) {
                static::$data_file = dirname($_SERVER['SCRIPT_FILENAME']).'/data.json';
            } else {
                static::$data_file = __DIR__.'/data.json'; // last chance, should not happen
            }
        }
        return static::$data_file;
    }

    /**
     * loads the data file into static::$data
     */
    public static function load($objects = false)
    {
        if (static::$data === null) {
            if (file_exists(static::getDataFile())) {
                $json = file_get_contents(static::getDataFile());
                static::$data = json_decode($json, true);
            }

            if (!static::$data) {
                static::$data = []; // [] indicates empty but loaded
            }
        }
    }

    /**
     * saves static::$data into the data file
     */
    public static function save()
    {
        $file = static::getDataFile();

        if (!file_exists(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }

        file_put_contents($file, json_encode(static::$data));

        chmod($file, 0777);
    }

    /**
     * inserts data, returns new id
     */
    public static function insert($data)
    {
        return static::update(null, $data);
    }

    /**
     * updates data, returns id
     *
     * merges the data with simple array_merge
     */
    public static function update($id = null, $data = [])
    {
        static::load();

        if (!$id) {
            if (count(static::$data)) {
                $id = max(array_keys(static::$data))+1;
            } else {
                $id = 1;
            }
        } elseif(!array_key_exists($id, static::$data)) {
            throw new \Exception('Trying to update a non-existant record. Record with this id does not exist.');
        }

        if (is_object($data)) {
            $data = (array)$data;
        }

        $data['id'] = $id;

        static::$data[$id] = array_merge(isset(static::$data[$id]) ? static::$data[$id] : [], $data);

        static::save();

        return $id;
    }

    /**
     * deletes one record based on it's id
     *
     * returns false if the record was not found
     */
    public static function delete($id)
    {
        static::load();

        if (array_key_exists($id, static::$data)) {
            unset(static::$data[$id]);

            static::save();

            return true;
        }

        return false;
    }

    /**
     * selects all records in the data file
     */
    public static function select($limit = null, $offset = null, $objects = false)
    {
        static::load();

        if ($limit || $offset) {
            $data = array_slice(static::$data, intval($offset), $limit ?: null, true);
        } else {
            $data = static::$data;
        }

        if ($objects === true) {
            foreach ($data as $key => &$item) {
                $item = static::hydrateObject($item);
            }
        } elseif ($objects && is_string($objects)) {
            foreach ($data as $key => &$item) {
                $item = static::hydrateObject($item, $objects);
            }
        }

        return $data;
    }

    /**
     * selects one record based on it's id
     */
    public static function find($id, $objects = false)
    {
        static::load();

        if (array_key_exists($id, static::$data)) {

            if ($objects === true) {
                return static::hydrateObject(static::$data[$id]);
            } elseif ($objects && is_string($objects)) {
                return static::hydrateObject(static::$data[$id], $objects);
            }

            return static::$data[$id];
        }

        return null;
    }

    /**
     * makes an object of a specific class from an array of data
     *
     * the class must have its relevant properties declared as public
     */
    protected static function hydrateObject(array $data, $class = 'stdClass')
    {
        $object = new $class;

        foreach ($data as $key => $value) {
            $object->{$key} = $value;
        }

        return $object;
    }
}

/**
 * global functions
 */

function insert($data)
{
    return DBBlackbox::insert($data);
}

function update($id, $data)
{
    return DBBlackbox::update($id, $data);
}

function delete($id)
{
    return DBBlackbox::delete($id);
}

function select($limit = null, $offset = null, $objects = false)
{
    return DBBlackbox::select($limit, $offset, $objects);
}

function find($id, $objects = false)
{
    return DBBlackbox::find($id, $objects);
}