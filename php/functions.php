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
            })
    </script>
    ";
}
