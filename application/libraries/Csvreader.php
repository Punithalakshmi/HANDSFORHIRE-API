<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* CSVReader Class
*
* $Id: csvreader.php 54 2009-10-21 21:01:52Z Pierre-Jean $
*
* Allows to retrieve a CSV file content as a two dimensional array.
* Optionally, the first text line may contains the column names to
* be used to retrieve fields values (default).
*
* Let's consider the following CSV formatted data:
*
*        "col1";"col2";"col3"
*         "11";"12";"13"
*         "21;"22;"2;3"
*
* It's returned as follow by the parsing operation with first line
* used to name fields:
*
*         Array(
*             [0] => Array(
*                     [col1] => 11,
*                     [col2] => 12,
*                     [col3] => 13
*             )
*             [1] => Array(
*                     [col1] => 21,
*                     [col2] => 22,
*                     [col3] => 2;3
*             )
*        )
*
* @author        Pierre-Jean Turpeau
* @link        http://www.codeigniter.com/wiki/CSVReader
*/
class Csvreader {
    
    var $fields;            /** columns names retrieved after parsing */
    var $separator = ';';    /** separator used to explode each line */
    var $enclosure = '"';    /** enclosure used to decorate each field */
    
    var $max_row_size = 15000;    /** maximum row size to be used for decoding */
    
    /**
     * Parse a file containing CSV formatted data.
     *
     * @access    public
     * @param    string
     * @param    boolean
     * @return    array
     */
    function parse_file($p_Filepath, $p_NamedFields = true, $p_indexedArray = false, $records_to_return = null) {
        $content = false;
        $file = fopen($p_Filepath, 'r');
        if($p_NamedFields) {
            $this->fields = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure);
            if (count($this->fields) == 1) {
                fseek($file, 0, SEEK_SET);
                $this->separator = ',';
                $this->fields = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure);
            }
        }

        if($p_indexedArray)
            $this->fields = range(0, count($this->fields)-1);
        
        while( ($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) != false ) {            
            if( $row[0] != null ) { // skip empty lines
                if( !$content ) {
                    $content = array();
                }
                if( $p_NamedFields ) {
                    $items = array();
                    
                    // I prefer to fill the array with values of defined fields
                    foreach( $this->fields as $id => $field ) {
                        if( isset($row[$id]) ) {
                            $items[strtolower($field)] = $row[$id];    
                        }
                    }
                    $content[] = $items;
                } else {
                    $content[] = $row;
                }
            }

            if( !is_null($records_to_return) && count($content) == $records_to_return)
                break;
        }
        fclose($file);
        return $content;
    }
}
