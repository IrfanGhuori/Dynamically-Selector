# Simple Shoutcast Server Information
About
-----
It's just another library to get information from a [Shoutcast Server](https://www.shoutcast.com/)  
It supports Shoutcast Server 2+.

Example
-----
```php
<?php

include 'shoutcast.php';

$s = new Shoutcast('10.211.55.3', '8000');

if (!$s->server_online()) {
    echo 'Server offline';
} else {
    if (0 == $s->get('STATION_STATUS')) {
        echo 'Transmition off';
    } else {
        $format = '<strong>%s:</strong> %s <br />';

        //Print Current Listeners
        printf($format, 'Current Listeners', $s->get('CURRENT_LISTENERS'));

        //Print Current Song
        printf($format, 'Current Song', $s->get('CURRENT_SONG'));

        //Print Song History
        if ($s->admin_mode()) {
            $str_history = '';
            foreach ($s->get('SONG_HISTORY') as $song) {
                $str_history .= '<br />'.$song['TITLE'];
            }

            printf($format, 'Song History', $str_history);
        }
    }
}

```


Public Methods
-----
public **Shoutcast::server_online** (void)  
Returns TRUE or FALSE depending on the server status.
If you want get the transmission status, use the STATION_STATUS variable.  

public **Shoutcast::admin_mode** (void)  
Returns TRUE or FALSE depending if it is in admin mode or not. You have to provide an admin password to the class constructor.  

public **Shoutcast::get** (string $var)  
Returns the value for the given var, if it is not available, it just returns an empty string  


Data Variables
------------------------------------
**CURRENT_LISTENERS** : Amount of current listeners.  
**CURRENT_SONG** : Current song  
**NEXT_SONG** : Guess what?  

**LISTENERS_PEAK** : Max simultaneous listeners at a certain moment  
**LISTENERS_LIMIT** : Max simultaneous listeners allowed  
**UNIQUE_LISTENERS** :  Amount of listeners by IP  
**STATION_STATUS** : TRUE or FALSE depending on whether someone is transmitting or not  

**STATION_GENRE**  
**STATION_URL**  
**STATION_TITLE**  

**DJ**  

**CONTENT_TYPE** : Content MIME  
**BITRATE** : Transmission bitrate  
**SERVER_VERSION**  

Only with admin password:  

**SONG_HISTORY** : Array ( TIMESTAMP, TITLE )  
**LISTENERS** : Array ( HOST, PLAYER, UNDER_RUNS, CONNECT_TIME, POINTER, UID})  

Ideas?
------------------------------------
As you already noticed, it doesn't cover all the XML API, only the most useful information, just to keep it simple.
If you need more, let me know! or fork it instead.
