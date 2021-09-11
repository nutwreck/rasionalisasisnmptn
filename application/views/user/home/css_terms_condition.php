<style>
   .text-paragraph { text-indent: 7%; margin-bottom: 10px; font-family: 'Arial Rounded MT', sans-serif;}
   .form-check { margin-left: 7%; margin-bottom:10px;}
   .btn {
        background-image: linear-gradient(to right, #006175 0%, #00a950 100%);
        border-radius: 30px;
        box-sizing: border-box;
        color: #00a84f;
        display: block;
        height: 50px;
        letter-spacing: 1px;
        font-size: 1.125rem;
        margin: 0 auto;
        padding: 2px;
        position: relative;
        text-decoration: none;
        text-transform: uppercase;
        width: 195px;
        z-index: 2;
    }

    .btn:hover {
        color: #fff;
    }

    .btn span {
        align-items: center;
        background: #e7e8e9;
        border-radius: 40px;
        display: flex;
        justify-content: center;
        height: 100%;
        transition: background .5s ease;
        width: 100%;
    }

    .btn:hover span {
        background: transparent;
    }

    @media only screen and (max-width: 640px) {
        .btn {
            border-radius: 25px;
            padding: 3px;
            height: 40px;
            width: 175px;
        }
        .front-text {
            font-size: 20px;
        }
    }
</style>