<!DOCTYPE html>
<html>
    <head>
        <title>A2LAMP Code Competition</title>
    </head>
    <body>
        <section>
                <p>
                    <label>from:</label>
                    <input type="text" maxlength="1" name="from"></input>
                </p>

                <p>
                    <label>to:</label>
                    <input type="text" maxlength="1" name="to"></input>
                </p>
                
                <button id="decode">DECODE</button>
        </section>
        
        <p id="encrypted" style="font-family:consolas;">
<?php
/**
 * Our approach was to get a head start on the decoding via a simple algorithm,
 * based on character frequency, then we manually converted each letter that 
 * wasn't successfully decode algorithmically.
 */
        
// first, we created an array of characters, 
// in order of estimated frequency in the English language 
// (based on the letter_frequency.txt + some educated guesses by the team).
$letters = str_split(strtoupper(' etaoinshrdlcumwfgypbvkjxqz,.?0123456789'));

// next, we pulled in one of the encrypted texts
$encrypted = file_get_contents('source-files/sample_1.txt');

// create an array to hold the frequency of each character in the encrypted text.
$encrypted_freq = array();

// loop through each character in our initial frequency key array, 
// counting the occurances of each char in the encrypted text.
foreach ( $letters as $letter ) {
    $encrypted_freq[$letter] = substr_count($encrypted, $letter);    
}

// sort the encrypted frequency array by frequency, in descending order.
arsort($encrypted_freq);

// create an array of just the encrypted chars
$encrypted_letters = array_keys($encrypted_freq);

// create a decode array, with the original freq key as the keys,
// and the encrypted freq array as the values
$cypher = array_combine($encrypted_letters, $letters);

// create an array of chars in the encrypted text
$encrypted_array = str_split($encrypted);

// loop through all chars in the encrypted text, replacing based on frequency.
foreach ( $encrypted_array as $encrypted_letter ) {
    if ( isset($cypher[$encrypted_letter]) ) {
        $encrypted_letter = $cypher[$encrypted_letter];
    }

    // print out each char as it's decoded.
    echo($encrypted_letter);
}   
                
?>
        </p>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>
        $(function() {
            // when we click the decode button, replace the from char in 
            // the encrypted text with the "to" char, as lowercase.
            $('#decode').click(function() {
                var encrypted, from, to, patt, decrypted;
                    
                encrypted = $('#encrypted').text();
                from      = $('input[name="from"]').val();
                to        = $('input[name="to"]').val();
                patt      = new RegExp(from.toUpperCase(), 'g');
                decrypted = encrypted.replace(patt, to.toLowerCase());
                
                $('#encrypted').text(decrypted);
            });
        });
        </script>
    </body>
</html>