
const iconMinus = document.querySelector(".product__minus");
const iconPlus = document.querySelector(".product__plus");
const quanity  = document.querySelector(".productDetail__input--quantity");
if(iconPlus)
{
	iconPlus.addEventListener("click",handlerClickPlus);

}
if(iconMinus)
{
	iconMinus.addEventListener("click",handlerClickMinus);
}
function handlerClickMinus(e) {
	const quanityValue  = +quanity.value;
	if(quanityValue === 0) 
	{
		return	quanity.value ===0;
	}
	return quanity.value = quanityValue - 1;
}
function handlerClickPlus(e) {
	const quanityValue  = +quanity.value;
	return quanity.value = quanityValue +1;
}



