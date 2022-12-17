<?php

/**
 * Helper functions that are callable anywhere
 * Just require this file in the head.php on partials
 */


/**
 * returns a javascript element that shows an error.
 * $message is what you want to see as message
 */
function showModalError($message)
{
    return "
    <script>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{$message}'
            confirmButtonColor: '#a35709',
            })
    </script>
    ";
}


/**
 * returns a javascript element that shows success message.
 * $message is what you want to see as message
 */
function showModalSuccess($message)
{
    return "
    <script>
            Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{$message}'
            confirmButtonColor: '#a35709',

            })
    </script>
    ";
}


/**
 * returns format based from code
 * 
 */
function getServiceName($code)
{
    switch ($code) {
        case 'clean':
            return 'Cleaning';
        case 'pasta':
            return 'Pasta';
        case 'd_crown':
            return 'Dental Crown';
        case 'wisdom':
            return 'Wisdom Tooth Extraction';
    }
}

/**
 * returns format based from code
 * 
 */
function getBranchName($code)
{
    switch ($code) {
        case 's_simon':
            return 'San Simon';
        case 'mexico':
            return 'Mexico';
    }
}
