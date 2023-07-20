<?php 

define('DB_NAME', 'F:/PHP Project/CRUD/data/db.txt');


/**
 * 
 * Seeding database data
 * 
 */

function seed(){
    $data = array(
        array(
            'roll' => 1,
            'fname' => 'kamal',
            'lname' => 'Ahamed',
        ),
        array(
            'roll' => 2,
            'fname' => 'Jamal',
            'lname' => 'Bhuiya',
        ),
        array(
            'roll' => 3,
            'fname' => 'Nikhil',
            'lname' => 'Chanrda',
        ),
        array(
            'roll' => 4,
            'fname' => 'Ripon',
            'lname' => 'Ahamed',
        ),
        array(
            'roll' => 5,
            'fname' => 'Jhon',
            'lname' => 'Rojario',
        ),
        array(
            'roll' => 6,
            'fname' => 'Robiul',
            'lname' => 'Islam',
        ),
    );

    $serializedData = serialize($data);

    file_put_contents(DB_NAME, $serializedData);
};


// Generate report

function generateReport(){
    $serializedData = file_get_contents(DB_NAME);
    $data = unserialize($serializedData);
    
    $html = '<table>
        <thead>
        <tr>
            <td>Full Name</td>
            <td>Roll</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
    ';

    foreach($data as $student){
        $html .= "
            <tr>
                <td>{$student['fname']} {$student['lname']}</td>
                <td>{$student['roll']}</td>
                <td><a href='index.php?task=edit&id={$student['roll']}'>Edit</a> | <a href='index.php?task=delete&id={$student['roll']}'>Delete</a></td>
            </tr>
        ";
    }
    echo $html .= "</tbody></table>";


}

