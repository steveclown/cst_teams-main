<?php
	if(empty($selection)){
		
	} else {
		echo "<ul>";
			foreach ($selection as $key=>$val){
				if($val!=''){
					$item 			= explode(',',$val);
					if($key=='participant'){
						$i				= 1;
						$jum 			= count($item);
						$selected_item 	= '';
						foreach ($item as $key2){
							if($i!=$jum){
								$selected_item .= $this->transactiontestingresult_model->getParticipantName($key2).', ';
							}else{
								$selected_item .= $this->transactiontestingresult_model->getParticipantName($key2);
							}
							$i++;
						}
					
					/* else if($key=='customer'){
						$i				= 1;
						$jum 			= count($item);
						$selected_item 	= '';
						foreach ($item as $key2){
							if($i!=$jum){
								$selected_item .=$this->projectmanagementdashboard_model->getCustomerName($key2).', ';
							}else{
								$selected_item .= $this->projectmanagementdashboard_model->getCustomerName($key2);
							}
							$i++;
						} */
					// }else if($key=='supplier'){
						// $i				= 1;
						// $jum 			= count($item);
						// $selected_item 	= '';
						// foreach ($item as $key2){
							// if($i!=$jum){
								// $selected_item .=$this->projectmanagementdashboard_model->getSupplierName($key2).', ';
							// }else{
								// $selected_item .= $this->projectmanagementdashboard_model->getSupplierName($key2);
							// }
							// $i++;
						// }
					}
					// else if($key=='Kode_Perkiraan'){
						// $i				= 1;
						// $jum 			= count($item);
						// $selected_item 	= '';
						// foreach ($item as $key2){
							// if($i!=$jum){
								// $selected_item .=$this->projectmanagementdashboard_model->getAccountName($key2).', ';
							// }else{
								// $selected_item .= $this->projectmanagementdashboard_model->getAccountName($key2);
							// }
							// $i++;
						// }
					// }
					
					echo "<li style='cursor:pointer;' > $key : $selected_item &nbsp;</li>";
				}else{
					continue;
				}
			}
		echo "</ul>";
	}
?>