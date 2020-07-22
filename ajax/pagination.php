<?php

function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "Anterior";
	$nextlabel = "Siguiente";
	$out = '<div class="container-fluid">
				<div class="row d-flex justify-content-end">
					<nav aria-label="Page navigation example"><ul class="pagination">';
					
	if($page==1) {
		$out.= "<li class='disabled'><span><a class='page-link'>$prevlabel</a></span></li>";
	} else if($page==2) {
		$out.= "<li class='page-item'><span><a class='page-link' href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
	}else {
		$out.= "<li class='page-item'><span><a class='page-link' href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a></span></li>";
	}
	
	if($page>($adjacents+1)) {
		$out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='load(1)'>1</a></li>";
	}

	if($page>($adjacents+2)) {
		$out.= "<li class='page-item'><a class='page-link'>...</a></li>";
	}

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class='active'><a class='page-link' id='a'>$i</a></li>";
		}else if($i==1) {
			$out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
		}else {
			$out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>";
		}
	}

	if($page<($tpages-$adjacents-1)) {
		$out.= "<li class='page-item'><a class='page-link'>...</a></li>";
	}

	if($page<($tpages-$adjacents)) {
		$out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='load($tpages)'>$tpages</a></li>";
	}

	if($page<$tpages) {
		$out.= "<li class='page-item'><span><a class='page-link' href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a></span></li>";
	}else {
		$out.= "<li class='disabled'><span><a class='page-link'>$nextlabel</a></span></li>";
	}
	
	$out.= "	</ul>
			</nav>
		</div>
	</div>";

	return $out;
}
?>