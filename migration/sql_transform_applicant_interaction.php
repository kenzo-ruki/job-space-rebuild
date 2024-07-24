<?php
// Open the SQL file
$file = fopen("old_applicant_interaction.sql", "r");


// Open a new SQL file to write the UPDATE statements
$newFile = fopen("new_applicant_interaction.sql", "w");

if ($file) {
    echo "Opening the file.\n";
    while (($line = fgets($file)) !== false) {
        // Print the line being read
        echo "Reading line: $line\n";
        
        // Check if the line contains INSERT
        if (strpos($line, 'INSERT') === false) {
            // Use regex to extract id and message
            $matchResult = preg_match("/\((\d+),\s(0x[a-fA-F0-9]+)\)/", $line, $matches);
            
            // Print the result of the preg_match function
            echo "Match result: $matchResult\n";
            
            if ($matchResult) {
                $id = $matches[1];
                $message = $matches[2];

                // Convert the blob back to HTML
                $message = utf8_encode(hex2bin(substr($message, 2)));

                // Escape the message for use in a SQL statement
                $message = addslashes($message);

                // Construct the UPDATE SQL statement
                $updateStatement = "UPDATE `applicant_interaction` SET `message` = '{$message}' WHERE `id` = {$id};\n";

                // Write the UPDATE SQL statement to the new SQL file
                fwrite($newFile, $updateStatement);
            }
        }
    }

    fclose($file);
    fclose($newFile);
} else {
    // Error opening the file
    echo "Error opening the file.\n";
}