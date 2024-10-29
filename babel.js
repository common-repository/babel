function setCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function babel(lang, me, home, ed, tTag) 
{
	setCookie('babel',lang,360);

  	var img = '<img src=\"$/wp-content/plugins/babel/£.gif\" border=\"0\" alt=\"£\" />';

    var d = document.getElementsByTagName('DIV');
      
    var mDivs = new Array();
			
	var r1 = new RegExp("\\b"+lang+"\\b");
			
	for (var i = 0; i < d.length; i++)
	{
		if(r1.test(d[i].className))
				mDivs[mDivs.length] = d[i];
	}
      	
	img = img.split('$').join(home);

    if(ed==1)
    {
    	me.innerHTML=img.split('£').join('d'+lang);
    		
    	for (var k=0; k < mDivs.length; k++)
    		mDivs[k].style.display = 'none';
    }
    else
    {
 		for (var i = 0; i < mDivs.length; i++) 
        	mDivs[i].style.display = 'block';
                  			
			me.innerHTML=img.split('£').join(lang);    
	}
	
	if("DIV" != tTag.toUpperCase())
	{
	
		var h = document.getElementsByTagName(tTag.toUpperCase());
		
		var r1 = new RegExp("\\b"+lang+"\\b");
	      
	    var mH1 = new Array();
							
		for (var i = 0; i < h.length; i++)
		{
			if(r1.test(h[i].className))
					mH1[mH1.length] = h[i];
		}
	      	
	    if(ed==1)
	    {
	    		
	    	for (var k=0; k < mH1.length; k++)
	    		mH1[k].style.display = 'none';
	    }
	    else
	    {
	 		for (var i = 0; i < mH1.length; i++) 
	        	mH1[i].style.display = 'block';
	                  			
		}
	}
	
	var a = document.getElementsByTagName('A');
	
	var r2 = new RegExp("\\b"+lang+"\\b");
      
    var mA = new Array();
						
	for (var i = 0; i < a.length; i++)
	{
		if(r2.test(a[i].className))
				mA[mA.length] = a[i];
	}
      	
    if(ed==1)
    {
    		
    	for (var k=0; k < mA.length; k++)
    		mA[k].style.display = 'none';
    }
    else
    {
 		for (var i = 0; i < mA.length; i++) 
        	mA[i].style.display = 'block';
                  			
	}

}   