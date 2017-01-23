/**
 * 弹出框
 */
var msgBox={
	"box_id":null,
	"box_parent_id":"#hint_box",
	"mask_id":"#mask",
	"callback_fun":null,
	"cancel_callback_fun":null,
	"close_callback_fun":null,
	"bland":false,

	"resize":function(){
		var h=$(window).height();
		var ch=$(this.box_id).height();
		var height = $('body').height()>$(window).height()? $('body').height():$(window).height();
		$(this.mask_id).height(height);
		if(h>ch){
			$(this.box_parent_id).css('top',(h-ch)/2);
		}else{
			$(this.box_parent_id).css('position','absolute');
			$(this.box_parent_id).css('top','0');
		}
		$(this.mask_id).height();
	},
	"show_hint_box":function(box_id,msg,callback,cancel_callback,close_callback){
		$(document).on("mousewheel DOMMouseScroll",function(evt) {
			evt.preventDefault();
		});
		this.box_id=box_id;
		if(callback){
			msgBox.callback_fun= callback;
		}
		if(cancel_callback){
			msgBox.cancel_callback_fun= cancel_callback;
		}
		if(close_callback){
            msgBox.close_callback_fun=close_callback;
		}
		$(this.box_parent_id+">div").hide();
		$(this.mask_id).css('display','block');
		$(this.box_parent_id).css('display','block');
		$(box_id).css('display','block');
		if(msg){
			$(box_id).find('.p-title').html(msg);
		}
		if(!this.bland){
			this.bind_event();
		}
		this.resize();
	},
	"hide_layout":function(){
		$(document).off("mousewheel DOMMouseScroll");
		$(this.mask_id).hide();
		$(this.box_parent_id).hide();
	},
	"bind_event":function(){
		$(this.box_parent_id+" .hint-close").click(function(){
            if(msgBox.close_callback_fun){
                msgBox.close_callback_fun();
                msgBox.hide_layout();
            }else{
                msgBox.hide_layout();
            }
		});
		$(this.box_parent_id+" .hint-enter").click(function(){
			if(msgBox.callback_fun){
				msgBox.callback_fun();
				msgBox.hide_layout();
			}else{
				msgBox.hide_layout();
			}
		});
		$(this.box_parent_id+" .hint-cancel").click(function(){
			if(msgBox.cancel_callback_fun){
				msgBox.cancel_callback_fun.call();
				msgBox.hide_layout();
			}else{
				msgBox.hide_layout();
			}
		});
		$(window).resize(function(){
			msgBox.resize();
		});
		this.bland=true;
	}
}