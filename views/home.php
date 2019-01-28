
<div class="container">
	<div class="card">	<!-- start of card -->
		
		<div class="row" style="padding-bottom: 25px; border-bottom: 3px solid #D19E21">
			<form class"form-inline" method="post" action="new_proposal">
				<h1 style="float: left;"><strong>My Proposals</strong></h1>
				<button type="submit" class="btn btn-new"><strong>New Proposal</strong></button>
			</form>
		</div>
		
		
		<!--<form class"form-inline" method="post" action="apply">
			<button type="submit" class="btn btn-apply"><strong>Apply</strong></button>
		</form>-->
		
		<div class="row" style="margin-top: 30px;">
			<div class="col-md-3">
				<span class="label-home"><strong>Title:</strong></span>
			</div>
			<div class="col-md-2">
				<span class="label-home"><strong>Date Created:</strong></span>
			</div>
			<div class="col-md-3">
				<span class="label-home"><strong>Submission Status:</strong></span>
			</div>
			<div class="col-md-2">
				<span class="label-home"><strong>Approval Status:</strong></span>
			</div>
			<div class="col-md-2">
				<span class="label-home"><strong>Options:</strong></span>
			</div>
			
		</div>
		
		<?php
		
			$q = "SELECT * FROM proposals WHERE user_id = '$user[id]'";
			$r = mysqli_query($dbc, $q);
			while($proposal = mysqli_fetch_assoc($r)){
				
				$course_id = $proposal['related_course_id'];
				//echo "course_id = ".$course_id."; ";
				$course_id_array = str_split($course_id);
				/*echo "course_id_array[0] = ".$course_id_array[0]."; ";
				echo "course_id_array[1] = ".$course_id_array[1]."; ";
				echo "course_id_array[2] = ".$course_id_array[2]."; ";
				echo "course_id_array[3] = ".$course_id_array[3]."; ";
				echo "course_id_array[4] = ".$course_id_array[4]."; ";*/
				
				$course_subj_code = $course_id_array[0].$course_id_array[1];
				$course_num = $course_id_array[2].$course_id_array[3].$course_id_array[4];
				
				/*echo "course_subj_code = ".$course_subj_code."; ";
				echo "course_num = ".$course_num."; ";*/
					
				$query = "SELECT * FROM courses WHERE subj_code = '$course_subj_code' AND course_num = '$course_num'";
				$result = mysqli_query($dbc, $query);
				$course = mysqli_fetch_assoc($result); 				
				
				$filename = str_replace(' ', '_', $proposal['proposal_title']);
				$filename = str_replace(',', '', $filename);
				$filename = str_replace("'", '', $filename);
								
				$department = $course['dept_desc'];
				$proposalType = $proposal['type'];
				
				$currentCourseTitle = $course['course_title'];
				$currentCourseDescription = $course['course_desc'];
				$currentCourseExtraDescription = $course['extra_desc'];
				$currentPrereqs = $course['prereqs'];
				$currentPostreqs = $course['postreqs'];
				$currentUnits = $course['units'];
				$currentCourseInfoHeader = 'CURRENT TITLE, COURSE DESCRIPTION, EXTRA COURSE DESCRIPTION, PREREQUISITES, POSTREQUISITES, AND UNITS:';
				
				$proposedCourseTitle = $proposal['proposed_course_title'];
				$proposedCourseDescription = $proposal['proposed_course_desc'];
				$proposedCourseExtraDescription = $proposal['proposed_extra_desc'];
				$proposedPrereqs = $proposal['proposed_prereqs'];
				$proposedPrereqs = $proposal['proposed_postreqs'];
				$proposedUnits = $proposal['units'];
				$proposedCourseInfoHeader = 'PROPOSED TITLE, COURSE DESCRIPTION, EXTRA COURSE DESCRIPTION, PREREQUISITES, POSTREQUISITES, AND UNITS:';
				
				$courseChangeDescription = $proposal['change_desc'];
				$rationale = $proposal['rationale'];
				$libraryImpact = $proposal['library_impact'];
				$techImpact = $proposal['tech_impact'];
				
				
				// New Word Document				
				$languageEnGb = new PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::EN_GB);
								
				$phpWord = new \PhpOffice\PhpWord\PhpWord();
				$phpWord->getSettings()->setThemeFontLang($languageEnGb);
				
				
				$paragraphStyle = 'pStyle';
				$phpWord->addParagraphStyle($paragraphStyle, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 280));
				
				$phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));
								
				// New portrait section
				$section = $phpWord->addSection();
				
				$deptHeaderStyle = 'deptHeader';
				$phpWord->addFontStyle($deptHeaderStyle, array('bold' => true, 'size' => 14, 'name' => 'Calibri'));
				
				$boldCapsStyle = 'boldCaps';
				$phpWord->addFontStyle($boldCapsStyle, array('bold' => true, 'allCaps' => true, 'size' => 12, 'name' => 'Calibri'));
				
				$boldStyle = 'bold';
				$phpWord->addFontStyle($boldStyle, array('bold' => true, 'size' => 12, 'name' => 'Calibri'));
				
				$standardStyle = 'standard';
				$phpWord->addFontStyle($standardStyle, array( 'size' => 12, 'name' => 'Calibri'));
				
				
				$section->addText($department, $deptHeaderStyle, $paragraphStyle);
				$section->addText('A) '.$proposalType, $boldCapsStyle, $paragraphStyle);
				$section->addText('1)'.$currentCourseTitle, $boldStyle, $paragraphStyle);
				$section->addText($courseChangeDescription, $standardStyle, $paragraphStyle);
				$section->addText($currentCourseInfoHeader, $boldCapsStyle, $paragraphStyle);
				$section->addText($currentCourseTitle, $boldStyle, $paragraphStyle);
				$section->addText('Course Description: '.$currentCourseDescription, $standardStyle, $paragraphStyle);
				$section->addText('Additional Description: '.$currentCourseExtraDescription, $standardStyle, $paragraphStyle);
				$section->addText('Prerequisites: '.$currentPrereqs, $standardStyle, $paragraphStyle);
				$section->addText('Postrequisites: '.$currentPostreqs, $standardStyle, $paragraphStyle);
				$section->addText('Units: '.$currentUnits, $standardStyle, $paragraphStyle);
				$section->addText($proposedCourseInfoHeader, $boldCapsStyle, $paragraphStyle);
				$section->addText($proposedCourseTitle, $boldStyle, $paragraphStyle);
				$section->addText('Course Description: '.$proposedCourseDescription, $standardStyle, $paragraphStyle);
				$section->addText('Additional Description: '.$proposedCourseExtraDescription, $standardStyle, $paragraphStyle);
				$section->addText('Prerequisites: '.$proposedPrereqs, $standardStyle, $paragraphStyle);
				$section->addText('Postrequisites: '.$proposedPostreqs, $standardStyle, $paragraphStyle);
				$section->addText('Units: '.$proposedUnits, $standardStyle, $paragraphStyle);
				$section->addText('Rationale: '.$rationale, $standardStyle, $paragraphStyle);
				$section->addText('Library Impact: '.$libraryImpact, $standardStyle, $paragraphStyle);
				$section->addText('Tech Impact: '.$techImpact, $standardStyle, $paragraphStyle);
								
				
				// Save file
				write($phpWord, $filename, $writers);
		?>
		
		<div class="row" style="margin-top: 50px; padding-bottom: 20px; border-bottom: 3px dotted #D19E21">
			
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo $proposal['proposal_title']; ?></strong></span>
			</div>
			<div class="col-md-2">
				<span class="info-home"><strong><?php echo $proposal['proposal_date']; ?></strong></span>
			</div>
			<div class="col-md-3">
				<span class="info-home"><strong><?php echo $proposal['sub_status']; ?></strong></span>
			</div>
			<div class="col-md-2">
				<span class="info-home"><strong><?php echo $proposal['approval_status']; ?></strong></span>
			</div>
			<div class="col-md-2">
				<form method="post" action="home">
					<a href='functions/phpwordsample/code/results/<?php echo $filename;?>.docx' class='btn btn-home'><strong>Download</strong></a><br>
					<button type="submit" class="btn btn-home" name="action" value="edit"><strong>Edit</strong></button><br>
					<button type="submit" class="btn btn-home" name="action" value="email"><strong>Email</strong></button><br>
					<button type="submit" class="btn btn-home" name="action" value="feedback"><strong>View Feedback</strong></button>
					
					<!--<button type="submit" class="btn btn-home" name="action" value="download"><strong>Download</strong></button>-->
					
					<input type="hidden" name="openedid" value="<?php echo $proposal['id']; ?>">
					
				</form>
			</div>
			
		</div>
			
			
			
			
		<?php } ?>
		
	</div>
</div>
