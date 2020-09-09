<style>
.footer > table{
/*no fixed footer*/
  position: fixed;
  width: 100%;
  background-color: #f9f9f9;
  bottom: 0;
  min-height: 2.5em;
  line-height: 2.5em;
  border-top: 1px solid #E6E9ED;
  z-index: 8000;
  color: #999;
  font-size:11px;
  font-weight:bold;
}
.page_date, .page_footer{
	display:none;
}
</style>
<footer class="footer">
<table>
<tbody>
<tr>
<td style="text-align:left; width:33%" class="page_date"><?php echo date('d/m/Y') ?></td>
<td style="text-align:center; width:33%" class="page_footer"></td>
<td style="text-align:right">Copyright © 2019 QuatroZero4 Sistemas</td>
</tr>
</tbody>
</table>
</footer>