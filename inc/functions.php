<?php

define('DB_NAME', 'F:/PHP Project/CRUD/data/db.txt');


/**
 * 
 * Seeding database data
 * 
 */

function seed()
{
    $data = array(
        array(
            'id' => 1,
            'roll' => 5,
            'fname' => 'kamal',
            'lname' => 'Ahamed',
        ),
        array(
            'id' => 2,
            'roll' => 15,
            'fname' => 'Jamal',
            'lname' => 'Bhuiya',
        ),
        array(
            'id' => 3,
            'roll' => 14,
            'fname' => 'Nikhil',
            'lname' => 'Chanrda',
        ),
        array(
            'id' => 4,
            'roll' => 12,
            'fname' => 'Ripon',
            'lname' => 'Ahamed',
        ),
        array(
            'id' => 5,
            'roll' => 8,
            'fname' => 'Jhon',
            'lname' => 'Rojario',
        ),
        array(
            'id' => 6,
            'roll' => 4,
            'fname' => 'Robiul',
            'lname' => 'Islam',
        ),
    );

    $serializedData = serialize($data);

    file_put_contents(DB_NAME, $serializedData);
};


// Generate report

function generateReport()
{
    $serializedData = file_get_contents(DB_NAME);
    $data = unserialize($serializedData);

    $html = '<table>
        <thead>
        <tr>
            <td>Full Name</td>
            <td>Roll</td>
            <td width="25%">Action</td>
        </tr>
        </thead>
        <tbody>
    ';

    foreach ($data as $student) {
        $html .= "
            <tr>
                <td>{$student['fname']} {$student['lname']}</td>
                <td>{$student['roll']}</td>
                <td><a href='index.php?task=edit&id={$student['id']}'>Edit</a> | <a href='index.php?task=delete&id={$student['id']}'>Delete</a></td>
            </tr>
        ";
    }
    echo $html .= "</tbody></table>";
}


function addStudent($fname, $lname, $roll)
{

    $found = false;

    $serializedData = file_get_contents(DB_NAME);
    $data = unserialize($serializedData);

    foreach ($data as $_student) {
        if ($_student['roll'] == $roll) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        $newId = count($data) + 1;
        $student = array(
            'id' => $newId,
            'fname' => $fname,
            'lname' => $lname,
            'roll' => $roll,
        );

        array_push($data, $student);

        $serializedData = serialize($data);
        file_put_contents(DB_NAME, $serializedData, LOCK_EX);
        return true;
    } else{
        return false;
    }
}
