<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package NQD Store
 */
 global $NHP_Options;?>
		<div id="site-footer" class="col-lg-12">
			<div class="col-lg-12 text-center" id="site-socials">
				<div class="buttons" style="color:#FFF;">
				<?php
if ( is_home() ) {
echo'<h2 style="font-size:17px;font-weight: bold;margin:0;color:#FFF;display: inline;">Tải Game cho android hay nhất việt nam</h2><br/>';
} 
?>
				
				Copyright © 2013 Gamehot.Mobi 
				</div>
			</div>
			<div class="col-lg-4">
			
			</div>
			<div class="col-lg-4">
			
			</div>
			<div class="col-lg-4">
			
			</div>
		</div>
	</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php wp_footer(); ?>
	<script>
		 $('#slider').carousel();
		 $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  e.target // activated tab
		  e.relatedTarget // previous tab
		})
	</script>
	<script>
	$('#view-all-comment a').click(function () {
	  $('#myTab a[href="#tab-comments"]').tab('show') // Select tab by name
	});
	$('a[href="#mostDownload"]').click(function () {
	if ($('.mostDownload').length == 0) {
		  $.ajax({
			url: ajaxurl,
			data: {
				'action':'mostDownloadTab',
				'type' :'POST'
			},
			success:function(data) {
				$('#mostDownload-loading').css('display','none');
				$('#mostDownload .list-app').append(data);
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});  
	}
	});
	$('a[href="#mostStar"]').click(function () {
	if ($('.mostStar').length == '0') {
		  $.ajax({
			url: ajaxurl,
			data: {
				'action':'mostStarTab',
				'type' :'POST'
			},
			success:function(data) {
				$('#mostStar-loading').css('display','none');
				$('#mostStar .list-app').append(data);
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});  
	}
	});
	</script>
  </body>
</html>