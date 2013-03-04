<!DOCTYPE html>
<html>
    <head>
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
<?

        $letters = str_split(strtoupper(' etaoinshrdlcumwfgypbvkjxqz,.?0123456789'));

        $encrypted = file_get_contents('sample_4.txt');

        $encrypted_freq = array();

        foreach ( $letters as $letter ) {
            $encrypted_freq[$letter] = substr_count($encrypted, $letter);    
        }

        arsort($encrypted_freq);

        $encrypted_letters = array_keys($encrypted_freq);

        $cypher = array_combine($encrypted_letters, $letters);
    
        $encrypted_array = str_split($encrypted);

        foreach ( $encrypted_array as $encrypted_letter ) {
            if ( isset($cypher[$encrypted_letter]) ) {
                $encrypted_letter = $cypher[$encrypted_letter];
            }
        
            echo($encrypted_letter);
        }   
                
?>
        </p>
        <script src="jquery.js"></script>
        <script>
        $(function() {
            $('#decode').click(function(){
                var encrypted = $('#encrypted').text();
                var from = $('input[name="from"]').val();
                var to = $('input[name="to"]').val();
                var patt = new RegExp(from.toUpperCase(), 'g');
                var decrypted = encrypted.replace(patt, to.toLowerCase());
                
                $('#encrypted').text(decrypted);
            });
        });
        </script>
    </body>
</html>