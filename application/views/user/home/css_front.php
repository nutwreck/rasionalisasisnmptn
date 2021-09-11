<style>
.btn {
	background-image: linear-gradient(to right, #006175 0%, #00a950 100%);
	border-radius: 40px;
    box-sizing: border-box;
	color: #00a84f;
	display: block;
	height: 80px;
	letter-spacing: 1px;
    font-size: 1.125rem;
	margin: 0 auto;
	padding: 4px;
	position: relative;
    text-decoration: none;
	text-transform: uppercase;
	width: 264px;
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

@media only screen and (max-width: 768px) {
    .btn {
        border-radius: 30px;
        padding: 3px;
        height: 65px;
        width: 210px;
    }
    .front-text {
        font-size: 20px;
	}
	.container {
		margin-top:30%;
	}
}
</style>