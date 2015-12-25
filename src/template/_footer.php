
<p><a href="<?php echo $homePath;?>">Home</a>
<?php if (isset($secondaryPath)) {
    print ' > <a href="' . $secondaryPath . '">' . $secondaryPathName . '</a>';
} ?>
</p>
<p class="copyright">inWebo Technologies © <?php print date('Y');?></p>

</body>
</html>
