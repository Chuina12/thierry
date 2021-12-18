const carosselimg = document.querySelector('.imgcaroussel');
const carosselbtn = document.querySelectorAll('.buttonc');
const nbimg = document.querySelectorAll('.imgcaroussel .img').length;

let imgindex = 1;
let translatex = 0;

carosselbtn.forEach(button =>{
	button.addEventListener('click', event =>{
		if (event.target.id === 'prev'){
			if (imgindex !== 1) {
				imgindex --;
				translatex += 300;
			}
		}else{
			if (imgindex !== nbimg) {
				imgindex++;
				translatex += 300;
			}
		}
		carosselimg.style.transform = 'translatex(${translatex}px)';
	});

});
