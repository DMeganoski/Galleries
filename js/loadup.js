jQuery(function($){
	
	if ($.fn.autogrow) $('textarea.TextBox').livequery(function() {
		$(this).autogrow();
	});
	
	var WebRoot = gdn.definition('WebRoot');
	var bWithDomain, bMakeMarkDownIDs, bAbsoluteURL;
	var UploadedData = [];
	
	if ($('#Form_RawData').length > 0) UploadedData = $('#Form_RawData').val().split("\n");
	
	var UpdateCheckBoxState = function() {
		bWithDomain = $('#Form_WithDomain').is(':checked');
		bMakeMarkDownIDs = $('#Form_MakeMarkDownIDs').is(':checked');
		bAbsoluteURL = $('#Form_AbsoluteURL').is(':checked');
	}
	
	var UpdateRawData = function() {
		var Data = [];
		var Index = 0;
		for (var i = 0; i < UploadedData.length; i++) {
			var Value = $.trim(UploadedData[i]);
			if (Value) {
				if (bWithDomain) Value = gdn.combinePaths(WebRoot, Value);
				else if (bAbsoluteURL) {
					var hostname =  document.location.protocol + '//' + document.location.hostname;
					Value = gdn.combinePaths(WebRoot, Value);
					Value = Value.substr(hostname.length)
					//console.log( document.location.protocol, '--', Value , hostname , hostname.length);
				}
				if (bMakeMarkDownIDs) Value = '['+(Data.length+1)+']: ' + Value;
			}
			Data[Data.length] = Value;
		}
		$("#Form_RawData").val(Data.join("\n"));
	}
	
	if ($('#Form_RawData').length > 0) {
		$('label[for=Form_WithDomain], label[for=Form_MakeMarkDownIDs], label[for=Form_AbsoluteURL]').click(function(){
			UpdateCheckBoxState();
			UpdateRawData();

		});
		
		UpdateCheckBoxState();
		UpdateRawData();
	}
	
});