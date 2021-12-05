# <center>Mudeo</center>  <hr style="border:1px solid gray"> </hr>
## Share and watch your medias
### Features:  🎥 Movies, 🎵 Music

Mudeo is a web application that allow you to upload up to 5 files. Mudeo is made also for streaming.

Accepted formats for medias:

-***mp3, waw, webm, mp4***

Accepted formats for cover image:

-***jpeg, jpg, webm, mp4***


Copy the project in your folder and install the database dump in your PhpMyAdmin. Follow the instructions to complete the installation.

## Prerequisites

-Apache Server

-PHP 5.6+

-Mysql Database

-FFMPEG

-PHP MAILER

Install LARAGON for an easy quickstart

## Routing
The router app/libraries/core.php accept 3 parameters.
```
call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
```


## Config 
Modify the app/config/config.php file according to your needs. You can use example.config.php file inside the same folder as an example based on my local settings.

## Upload Media
The file that manage the uploading is under app/controllers/medias/add. When a cover image is add the file is resized to the correct Ratio.
Video size must be < 1gb. When the video is uploaded the FFMMPEG libraries first compress and resize the video to 1920x1080 px format. Video is renamed with an unique id and place into public/entities/videos and the link is added to bdd.entities.full_media.
