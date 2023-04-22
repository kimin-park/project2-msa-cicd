<?php
// Silence is golden.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>기민 하나 은진 둘 - 두번째 페이지</title>
</head>
<body>
    <header>
        <b>2조 기민 하나 은진 둘  - 두번째 페이지<b>
    </header>
    <section class="sec1">
        <article>
            <div> <a href="http://www.metanettplatform.co.kr/"> <img class="img1"  src="metanet-com03.png"></a></div>
            <div> <a href="http://www.metanetdigital.co.kr/"> <img src="new_metanet-com06.png"></a></div>
            <div> <a href="https://metanetglobal.com/"> <img src="metanet-com01.png"></a></div>
        </article>
        <section class="inner">
                <div> <img src="wordpress_1.jpg"> </div>
            </section>
            <section class="youtube">
                <iframe max-height="100%"  src="https://www.youtube.com/embed/P-98JrTlDV8?autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </section>
    </section>
</body>
<style>
    .sec1 {
    background-image: url(main_visual01.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed; 
    text-align: center;
    position: relative;
    height: 2800px;
    }
    .inner{
        position: relative;
    }
    .inner>div{
        padding-top: 1000px;
      
    }
    .inner>div>img{
        width:1300px;
    }
    article{
    position: absolute;
    top: 200px;
    left: 39%;
    height: 720;
    }
    img{
        width: 300px;
    }
    div{
        height: 130px;
    }
    .img1{
       width: 310px;
    }
    header{
    width: 100%;
    padding: 20px 80px 0;
    position: fixed;
    display: flex;
    justify-content: space-between;
    box-sizing: border-box;
    z-index: 99999;

    }
    header>b{
    color: #FFF;
    text-shadow: #333;
    z-index: 9999;
    }
    iframe{
        position: absolute;
        left: 200px;
        padding-top: 900px;
        width:1120px;
        height:680px;
    }
</style> 
