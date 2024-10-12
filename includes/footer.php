<!--end footer-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/js/jquery-2.1.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
<script src="/js/responsive-slider.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/pages/sessions.js"></script>
<script>
	wow = new WOW({

		})
		.init();
</script>
</body>

</html>
<?php if (isset($stmt)) {
	$stmt->close();
}
?>
<?php if (isset($conn)) {
	$conn->close();
} ?>