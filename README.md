# subcut

This can be used when you removed a portion of video, and then all the srt files needs to be adjusted.

Run the following command:
$run.php [filename] [offset in millisecond] [timecode]


for example run.php hello.srt -1200 01:02:00 will move every timecode by 1200ms in the srt file, starting 1:02.
So if at 1:02 you removed a clip that last 1200ms, runnning this command will adjust the subtitles as needed.

  
