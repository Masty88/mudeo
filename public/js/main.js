/*---PRELOADER---*/
const preloader= document.getElementById("preloader");
//when state is ready hide the preloader
document.onreadystatechange = function () {
    //when document is complete
    if (document.readyState == "complete") {
        //add animation in order to translate the preloader
        setTimeout(function (){
            preloader.style.cssText = "display:none";
        },1000)
    }
};

/*---PAGE LOGIN---*/
const videoIntro=document.getElementsByClassName('playIntro');

if(videoIntro[0]){
    document.addEventListener('DOMContentLoaded', ()=>{
       console.log("play");
       setTimeout(function(){
           videoIntro[0].play();
           },
           1000)
       //videoIntro.removeAttribute("muted");
    })
}

/*---PAGE HOME---*/
document.addEventListener('DOMContentLoaded', () => {

    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach( el => {
            el.addEventListener('click', () => {

                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);

                // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
        });
    }

});

/*
 * Toogle volume
 * In hero preview in landing page
 */

const muted=document.getElementById("mute");
const iconMuted=document.getElementById("iconMute")

if(muted){
    muted.addEventListener("click", function (){
        if(iconMuted.classList.contains("fa-volume-mute")){
            iconMuted.classList.remove("fa-volume-mute");
            iconMuted.classList.add("fa-volume-up")
            muted.classList.remove("is-danger");
            muted.classList.add("is-white");
            playSound();
        }
        else if(iconMuted.classList.contains("fa-volume-up")){
            iconMuted.classList.remove("fa-volume-up");
            iconMuted.classList.add("fa-volume-mute")
            muted.classList.remove("is-white");
            muted.classList.add("is-danger");
            muteSound();
        }
    });

    function playSound(){
        console.log("play");
        videoIntro[0].muted= false;
        videoIntro[0].volume= 1;
    }

    function muteSound(){
        console.log("mute");
        videoIntro[0].volume= 0;
    }
}

const columnsScroll= document.getElementsByClassName('scroll');
const  previewContainer= document.getElementsByClassName('preview-container')

if(columnsScroll){
    for(let i=0; i<previewContainer.length;i++ ){
        previewContainer[i].addEventListener('mouseover',()=>{
            for(let j=0; j<columnsScroll.length;j++){
                columnsScroll[j].style.overflowX= "visible";
            }
        })
        previewContainer[i].addEventListener('mouseout',()=>{
            for(let j=0; j<columnsScroll.length;j++){
                columnsScroll[j].style.overflowX= "auto";
            }
        })
    }
}

/*
 * Toggle attribute hidden
 * In hero preview in landing page
 */

const previewImage=document.getElementById("previewImage");
const previewVideo=document.getElementById("previewVideo");

if(previewVideo){
    previewVideo.addEventListener("ended", (event)=>{
        if(previewImage.hasAttribute("hidden")){
            previewImage.toggleAttribute("hidden");
            previewVideo.hidden= true;
        }
    })
}

/*---PAGE MEMBER---*/
const personalInfoDiv= document.getElementById("personalInfo");
const bioDiv= document.getElementById("bio");
const mediaDiv=document.getElementById("media");

const personalInfoBtn= document.getElementById("personalInfoBtn");
const bioBtn= document.getElementById("bioBtn");
const mediaBtn= document.getElementById("mediaBtn");

if(personalInfoDiv) {

    bioBtn.addEventListener("click", event=>{
        personalInfoDiv.style.display="none";
        bioDiv.style.display="flex";
    })

    personalInfoBtn.addEventListener("click", event=>{
        personalInfoDiv.style.display="flex";
        bioDiv.style.display="none";
    })

    class BulmaModal {
        constructor(selector) {
            this.elem = document.querySelector(selector)
            this.close_data()
        }

        show() {
            this.elem.classList.toggle('is-active')
            this.on_show()
        }

        close() {
            this.elem.classList.toggle('is-active')
            this.on_close()
        }

        close_data() {
            var modalClose = this.elem.querySelectorAll("[data-bulma-modal='close'], .modal-background")
            var that = this
            modalClose.forEach(function(e) {
                e.addEventListener("click", function() {

                    that.elem.classList.toggle('is-active')

                    var event = new Event('modal:close')

                    that.elem.dispatchEvent(event);
                })
            })
        }

        on_show() {
            var event = new Event('modal:show')

            this.elem.dispatchEvent(event);
        }

        on_close() {
            var event = new Event('modal:close')

            this.elem.dispatchEvent(event);
        }

        addEventListener(event, callback) {
            this.elem.addEventListener(event, callback)
        }
    }

    var btn = document.querySelector("#btn")
    var mdl = new BulmaModal("#myModal")

    btn.addEventListener("click", e=> {
        e.preventDefault();
        mdl.show()
    })

    mdl.addEventListener('modal:show', function() {
        console.log("opened")
    })

    mdl.addEventListener("modal:close", function() {
        console.log("closed")
    })
}


/*---FETCH TO ADD TO WATCH LIST ---*/

const form= document.getElementsByClassName('watchlist');
const likedForm=document.getElementsByClassName("likedList")
const unLikedForm=document.getElementsByClassName("unlikedList")

const entityId= document.getElementsByClassName('entityId');
const entityLikeId= document.getElementsByClassName('entityIdLike');
const entityUnlikeId= document.getElementsByClassName('entityIdUnLike');

const changeBtn=document.getElementsByClassName('change');
const changeIcon=document.getElementsByClassName("changeIcon");
const changeToLike=document.getElementsByClassName("changeToLike");
const changeToUnLike=document.getElementsByClassName("changeToUnLike");

if(form){
    for(let i=0; i< form.length;i++){
        form[i].addEventListener('submit', async e=> {
            let index= Array.from(form).indexOf(e.target);
            //prevent default on submit
            e.preventDefault();
            let pathToId='/medias/addtowatchlist/'+""+ entityId[index].value;
            const body = new FormData(form[i]);
            /*-------fetch send data from php to js-------*/
            const req = await fetch(pathToId, {
                method: 'POST',
                headers:{
                    'Accept' : 'application/json'
                },
                body,
            });
            const res = await req.json();
            changeBtn[index].setAttribute("disabled","");
            changeIcon[index].classList.remove("fa-plus");
            changeIcon[index].classList.add("fa-check");
        });
    }
    for(let j=0;j<likedForm.length;j++){
        likedForm[j].addEventListener('submit', async e=> {
            //prevent default on submit
            e.preventDefault();
            let indexLike= Array.from(likedForm).indexOf(e.target);
            const body = new FormData(likedForm[j]);
            if(likedForm[indexLike].classList.contains("toggle")){
                let pathToIdUnlike='/medias/removefromlikelist/'+""+ entityLikeId[indexLike].value;
                /*-------fetch send data from php to js-------*/
                const req = await fetch(pathToIdUnlike, {
                    method: 'POST',
                    headers:{
                        'Accept' : 'application/json'
                    },
                    body,
                });
                const res = await req.json();
                changeToLike[indexLike].classList.remove("is-success");
                likedForm[indexLike].classList.remove("toggle");
            }else{
                let pathToIdLike='/medias/addtolikedlist/'+""+ entityLikeId[indexLike].value;
                /*-------fetch send data from php to js-------*/
                const req = await fetch(pathToIdLike, {
                    method: 'POST',
                    headers:{
                        'Accept' : 'application/json'
                    },
                    body,
                });
                const res = await req.json();
                console.log(res);
                changeToLike[indexLike].classList.add("is-success");
                likedForm[indexLike].classList.add("toggle");
            }


        })
    }

    for(let x=0;x< unLikedForm.length;x++){
        unLikedForm[x].addEventListener('submit', async e=> {
            //prevent default on submit
            e.preventDefault();
            let indexUnlike= Array.from(unLikedForm).indexOf(e.target);

            if(unLikedForm[indexUnlike].classList.contains("toggle")){
                let pathToIdUnlike='/medias/addtolikedlist/'+""+ entityUnlikeId[indexUnlike].value;
                /*-------fetch send data from php to js-------*/
                const body = new FormData(unLikedForm[x]);
                const req = await fetch(pathToIdUnlike, {
                    method: 'POST',
                    headers:{
                        'Accept' : 'application/json'
                    },
                    body,
                });
                const res = await req.json();
                changeToUnLike[indexUnlike].classList.add("is-success");
                unLikedForm[indexUnlike].classList.remove("toggle");
            }else{
                let pathToIdUnlike='/medias/removefromlikelist/'+""+ entityUnlikeId[indexUnlike].value;
                const body = new FormData(unLikedForm[x]);
                /*-------fetch send data from php to js-------*/
                const req = await fetch(pathToIdUnlike, {
                    method: 'POST',
                    headers:{
                        'Accept' : 'application/json'
                    },
                    body,
                });
                const res = await req.json();
                changeToUnLike[indexUnlike].classList.remove("is-success");
                unLikedForm[indexUnlike].classList.add("toggle");
            }

        })

    }
}

/*---SEARCH ENGINE ---*/

const searchEngine= document.getElementById("searchEngine");
const inputSearch=document.getElementById("form-search");

if(searchEngine){
    searchEngine.addEventListener('submit', async e=> {
        //prevent default on submit
         e.preventDefault();
        const body = new FormData(searchEngine);
        /*-------fetch send data from php to js-------*/
        const req = await fetch('/medias/search', {
            method: 'POST',
            headers:{
                'Accept' : 'application/json'
            },
            body,
        });
        const res = await req.json();
        if (!res.success) {
            inputSearch.classList.add("is-danger");
        }else{
            window.location.assign('viewsearch');
        }
    })
}

/*---PAGE UPLOAD---*/
const uploadForm= document.getElementById("uploadForm");

if(uploadForm){
    uploadForm.addEventListener('submit', async e=> {
        //prevent default on submit
        e.preventDefault();
        preloader.style.cssText = "display:flex";

        /*-------recover group from html-------*/

        //title
        const titleGroup=document.getElementById("title-group");
        const titleInput=document.getElementById("form-title");
        let titleError;

        //body
        const bodyGroup=document.getElementById("body-group");
        const bodyInput=document.getElementById("body-post");
        let bodyError;

        //category
        const categoryGroup=document.getElementById("category-group");
        const categoryInput=document.getElementById("form-category");
        let categoryError;

        //cover
        const coverGroup=document.getElementById("cover-group");
        const coverInput=document.getElementById("form-cover");
        let coverError;

        //media
        const mediaGroup=document.getElementById("media-group");
        const mediaInput=document.getElementById("form-media");
        let mediaError;

        /*-------Reset form on submit-------*/

        //title error
        titleInput.classList.remove("is-danger");
        const titleErrorMessage=document.getElementById('invalid-title');
        removeErrors(titleErrorMessage);

        //Body error
        bodyInput.classList.remove("is-danger");
        const bodyErrorMessage=document.getElementById('invalid-body');
        removeErrors(bodyErrorMessage);

        //Category error
        categoryInput.classList.remove("is-danger");
        const categoryErrorMessage=document.getElementById('invalid-category');
        removeErrors(categoryErrorMessage);

        //Cover error
        coverInput.classList.remove("is-danger");
        const coverErrorMessage=document.getElementById('invalid-cover');
        removeErrors(coverErrorMessage);

        //Media error
        mediaInput.classList.remove("is-danger");
        const mediaErrorMessage=document.getElementById('invalid-media');
        removeErrors(mediaErrorMessage);


        const body = new FormData(uploadForm);
        /*-------fetch send data from php to js-------*/
        const req = await fetch('/medias/add', {
            method: 'POST',
            headers:{
                'Accept' : 'application/json'
            },
            body,
        });
        const res = await req.json();

        // if error in form send message to user
        if (!res.success) {
            console.log(res);
            preloader.style.cssText = "display:none";

            manageErrors(
                res.title_err,
                titleInput,
                titleError,
                titleGroup,
                'invalid-title',
                "Please enter the title",
            )

            manageErrors(
                res.body_err,
                bodyInput,
                bodyError,
                bodyGroup,
                'invalid-body',
                "Please enter the description",
            )

            manageErrors(
                res.category_err,
                categoryInput,
                categoryError,
                categoryGroup,
                'invalid-category',
                "Please choose the category",
            )

            manageErrors(
                res.cover_err,
                coverInput,
                coverError,
                coverGroup,
                'invalid-cover',
                "Please upload a cover image maximum size is 3mb",
            )

            manageErrors(
                res.media_err,
                mediaInput,
                mediaError,
                mediaGroup,
                'invalid-media',
                "Please upload your file maximum size is 1gb",
            )



        }else{
            window.location.assign('index')
        }

        function manageErrors(resError,input,message,group,idError,textMessage){
            if (resError) {
                input.classList.add("is-danger")
                message=document.createElement("p");
                message.setAttribute('id',idError);
                message.innerHTML= textMessage;
                group.append(message);
            }
            else{
                input.classList.add("is-success")
            }
        }

        function removeErrors(errorMessage){
            if(errorMessage){
                errorMessage.remove();
            }
        }

    })
}



