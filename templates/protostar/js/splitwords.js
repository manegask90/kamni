var splitEl = document.querySelector('.company_name')
var splitItems = splitEl.innerHTML.split(' ');
var splitMassive = splitItems;


for (var i=0; i < splitMassive.length; i++) {
	var countChar = splitMassive[i].length;
	
	if (countChar > 26) {
		splitEl.classList.add('small_fontsize');		
	} 
	
}