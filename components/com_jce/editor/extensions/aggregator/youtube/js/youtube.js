/* jce - 2.6.9 | 2017-03-09 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2017 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
WFAggregator.add("youtube",{params:{width:560,height:315,embed:!0},props:{rel:1,autoplay:0,controls:1,showinfo:1,enablejsapi:0,loop:0,playlist:"",start:"",end:"",privacy:0},setup:function(){},getTitle:function(){return this.title||this.name},getType:function(){return $("#youtube_embed:visible").is(":checked")?"flash":"iframe"},isSupported:function(v){return"object"==typeof v&&(v=v.src||v.data||""),!!/youtu(\.)?be(.+)?\/(.+)/.test(v)&&"youtube"},getValues:function(src){var id,self=this,data={},args={},type=this.getType(),query={},u=this.parseURL(src);u.query&&(query=Wf.String.query(u.query)),$.extend(args,query),src=src.replace(/^(http:)?\/\//,"https://"),$(":input","#youtube_options").not("#youtube_embed, #youtube_https, #youtube_privacy").each(function(){var k=$(this).attr("id"),v=$(this).val();k=k.substr(k.indexOf("_")+1),$(this).is(":checkbox")&&(v=$(this).is(":checked")?1:0),self.props[k]!==v&&""!==v&&(args[k]=v)}),src=src.replace(/youtu(\.)?be([^\/]+)?\/(.+)/,function(a,b,c,d){return d=d.replace(/(watch\?v=|v\/|embed\/)/,""),b&&!c&&(c=".com"),id=d.replace(/([^\?&#]+)/,function($0,$1){return $1}),"youtube"+c+"/"+("iframe"==type?"embed":"v")+"/"+d}),id&&args.loop&&!args.playlist&&(args.playlist=id),src=$("#youtube_privacy").is(":checked")?src.replace(/youtube\./,"youtube-nocookie."):src.replace(/youtube-nocookie\./,"youtube."),"iframe"==type?$.extend(data,{allowfullscreen:!0,frameborder:0}):$.extend(!0,data,{param:{allowfullscreen:!0,wmode:"opaque"}});var q=$.param(args);return q&&(src=src+(/\?/.test(src)?"&":"?")+q),data.src=src,data},parseURL:function(url){var o={};return url=/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@\/]*):?([^:@\/]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(url),$.each(["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],function(i,v){var s=url[i];s&&(o[v]=s)}),o},setValues:function(data){var self=this,id="",src=data.src||data.data||"",query={};if(!src)return data;var u=this.parseURL(src);if(u.query&&(query=Wf.String.query(u.query)),data=$.extend(data,query),src=src.replace(/^(http:)?\/\//,"https://"),src.indexOf("youtube-nocookie")!==-1&&(data.youtube_privacy=!0),query.v)id=query.v,delete query.v;else{var s=/\/?(embed|v)?\/([\w-]+)\b/.exec(u.path);s&&"array"===$.type(s)&&(id=s.pop())}return data.playlist&&(data.playlist=decodeURIComponent(data.playlist)),data.playlist===id&&(data.playlist=null),query.wmode&&delete query.wmode,$.each(query,function(k,v){"undefined"==typeof self.props[k]&&$("#youtube_options").append('<div class="uk-form-row"><label class="uk-form-label uk-width-2-10" for="youtube_'+k+'">'+k+'</label><div class="uk-form-row uk-width-8-10"><input type="text" id="youtube_'+k+'" value="'+v+'" /></div></div>')}),src=src.replace(/youtu(\.)?be([^\/]+)?\/(.+)/,function(a,b,c,d){var args="youtube";if(b&&(args+=".com"),c&&(args+=c),args+="/embed",args+="/"+id,u.anchor){var s=u.anchor;s=s.replace(/(\?|&)(.+)/,""),args+="#"+s}return args}).replace(/\/\/youtube/i,"//www.youtube"),data.src=src,data},getAttributes:function(src){var args={},data=this.setValues({src:src})||{};return $.each(data,function(k,v){"src"!==k&&(args["youtube_"+k]=v)}),args=$.extend(args,{src:data.src||src,width:this.params.width,height:this.params.height})},setAttributes:function(){},onSelectFile:function(){},onInsert:function(){}});