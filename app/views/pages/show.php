<?php require APPROOT.'/views/inc/headerfull.php';?>
<input id="test" type="hidden" value="<?= $data['next_video']->id; ?>">
    <section class="hero is-large is-relative is-justify-content-center" style="height: 100vh" >
        <video class="showVideo" controls>
            <source src="<?= URLROOT?>/<?= $data['entity']->full_media; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="previewOverlay">
            <div class="mainDetailsShow is-flex is-flex-direction-column">
                <div class="buttonsShow">
                <div class="columns back">
                    <div class="column ml-4">
                        <button class="button is-medium buttonMainHero" style="color: white; background-color: transparent;border: none" onclick="goBack()">
                            <span class="icon">
                        <i class="fas fa-long-arrow-alt-left"></i>
                      </span>
                        </button>
                    </div>
                </div>

                    <div class="columns play">
                        <div class="column"></div>
                        <div class="column has-text-centered">
                            <button class="button is-large is-outlined is-purple" style="color: white; background-color: transparent;border: none" onclick="play()">
                            <span class="icon">
                        <i class="fas fa-play"></i>
                      </span>
                            </button>
                        </div>
                        <div class="column"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="afterViewOverlay">
            <div class="mainDetailsShow is-flex is-flex-direction-column">
                <div class="buttonsShow">
                    <div class="columns back">
                        <div class="column ml-4">
                            <button class="button is-medium buttonMainHero" style="color: white; background-color: transparent;border: none" onclick="goBack()">
                            <span class="icon">
                        <i class="fas fa-long-arrow-alt-left"></i>
                      </span>
                            </button>
                        </div>
                    </div>

                    <div class="columns is-flex-mobile play">
                        <div class="column"></div>
                        <div class="column is-1 is-gapless has-text-centered">
                            <button class="button is-large is-outlined is-purple" style="color: white; background-color: transparent;border: none" onclick="replay()">
                            <span class="icon">
                        <i class="fas fa-envelope"></i>
                      </span>
                            </button>
                        </div>
                        <div class="column is-1 is-gapless has-text-centered">
                            <button class="button is-large is-outlined is-purple" style="color: white; background-color: transparent;border: none" onclick="replay()">
                            <span class="icon">
                        <i class="fas fa-reply"></i>
                      </span>
                            </button>
                        </div>
                        <div class="column"></div>
                    </div>

                    <div class="columns nextVideo">
                        <div class="column"></div>
                        <div class="column is-flex is-justify-content-center">
                            <div class="previewContainer mt-4">
                                <p class="subtitle has-text-white" id="countdown"></p>
                                <div class="image preview-container">
                                    <img src="<?= URLROOT ?>/<?= $data['next_video']->thumbnail; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="column"></div>

                    </div>

                </div>
            </div>
        </div>
    </section>

<script>
    const showVideo= document.getElementsByClassName("showVideo");
    const previewOverlay=document.getElementsByClassName("previewOverlay")
    const afterViewOverlay=document.getElementsByClassName("afterViewOverlay")
    const id= document.getElementById("test").value;
    console.log("http://mudeo.test/pages/show/" + test);
    function goBack() {
        window.history.back();
    }
    function play(){
        showVideo[0].play();
        previewOverlay[0].style.cssText="display:none;";
    }

    function replay(){
        afterViewOverlay[0].style.cssText="display:none;";
        showVideo[0].currentTime = '0';
        showVideo[0].play();
    }

    showVideo[0].addEventListener("pause",(e)=>{
        previewOverlay[0].style.cssText="display:block;";
    })

    //When video end
    showVideo[0].addEventListener('ended',(e)=>{
           console.log("end");
           previewOverlay[0].style.cssText="display:none;";
           afterViewOverlay[0].style.cssText="display:block;";
            let timeleft = 5;
        if(showVideo[0].currentTime !== '0'){
            let downloadTimer = setInterval(function(){
                    if(timeleft <= 0){
                        console.log("ok");
                        clearInterval(downloadTimer);
                        document.getElementById("countdown").innerHTML = "Finished";
                        document.location.href="http://mudeo.test/pages/show/" + id;

                    } else {
                        document.getElementById("countdown").innerHTML = "Next video play in " + timeleft + " seconds";
                    }
                    timeleft -= 1;
                }, 1000);
                }
    },false)



</script>


<?php require APPROOT.'/views/inc/footer.php';?>


