$(function() {

	$('#slider ul').jcarousel({
		'scroll': 1,
		'auto': 3,
		'wrap': 'both',
		initCallback: mycarousel_initCallback
	});
	
	if ($.browser.msie && $.browser.version == 6) {
		DD_belatedPNG.fix('#top, #bottom, #main, .inner, #header, h1#logo a, #navigation, #navigation li, #navigation a, #slider, .button, .jcarousel-prev, .jcarousel-next, #content, .more, #content li, .logo a, #testimonial');
	}
	
	$(window).load(function(){
	  fix_nav_paddings();
	});
});

function fix_nav_paddings(){
	_width = $('#navigation').width();
	_length = $('#navigation li').length;
	_sum = 0;
	$('#navigation li').each(function(){
		_sum += $(this).find('span').width();
	});
	_padding = Math.floor((_width - _sum) / (_length * 2));
	_remainder = 0;
	$('#navigation li').each(function(){
		_remainder += $(this).find('span').outerWidth();
	});
	$('#navigation li span').css('padding', '0 ' + _padding + 'px');
	$('#navigation li.last span').css('padding-right', (_padding + _width - _remainder - 1) + 'px');
}

function mycarousel_initCallback(carousel) {
	
	$('.jcarousel-prev, .jcarousel-next').hover(function(){
		$(this).addClass('carousel-active');
	}, function(){
		$(this).removeClass('carousel-active');
	});
	
};


	
function addElement() {

  var ni = document.getElementById('myDiv');
  var numi = document.getElementById('theValue'); 
  var num = (document.getElementById('theValue').value -1)+ 2;
  numi.value = num;
  var newtr = document.createElement('tr');
  
  
  //newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>';
  newtr.innerHTML = '<tr> <td>'+num+'</td> <td><select name=reftrans'+num+'><? foreach($option as $options) { ?><option value=<?=$options['id']?> > <?=$options['namaakun']?> </option><? } ?></select></td> <td><input type=text onkeyup="\cekK('+num+')"\ name=debittrans'+num+' id=debittrans'+num+'  /></td> <td><input type=text onkeyup="\cekD('+num+')"\ name=kredittrans'+num+' id=kredittrans'+num+' /></td> <td>&nbsp;</td> </tr>';

  ni.appendChild(newtr);

}

function cekD(num) {	
	var debit=document.getElementById("debittrans"+num);
	var kredit=document.getElementById("kredittrans"+num);
	//alert(x.value);
	debit.value = 0;	
}	

function cekK(num) {	
	var debit=document.getElementById("debittrans"+num);
	var kredit=document.getElementById("kredittrans"+num);
	//alert(x.value);
	kredit.value = 0;	
}
