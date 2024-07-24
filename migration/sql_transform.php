<?php
// Open the SQL file
$file = fopen("old_descriptions.sql", "r");

// Open a new SQL file to write the UPDATE statements
$newFile = fopen("new_descriptions.sql", "w");

if ($file) {
    while (($line = fgets($file)) !== false) {
        // Use regex to extract recruiter_id and recruiter_description
        if (preg_match("/\((\d+),\s(0x[a-fA-F0-9]+)\)/", $line, $matches)) {
            $recruiter_id = $matches[1];
            $recruiter_description = $matches[2];

            // Convert the blob back to HTML
            $recruiter_description = utf8_encode(hex2bin(substr($recruiter_description, 2)));

            // Escape the recruiter_description for use in a SQL statement
            $recruiter_description = addslashes($recruiter_description);

            // Construct the UPDATE SQL statement
            $updateStatement = "UPDATE `recruiters` SET `recruiter_description` = '{$recruiter_description}' WHERE `recruiter_id` = {$recruiter_id};\n";

            // Write the UPDATE SQL statement to the new SQL file
            fwrite($newFile, $updateStatement);
        }
    }

    fclose($file);
    fclose($newFile);
} else {
    // Error opening the file
    echo "Error opening the file.\n";
}