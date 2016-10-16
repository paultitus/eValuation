<div class="no-print buttons-container">
	<button type="button" class="btn btn-primary" onclick="window.print();">Print</button>
	<button class="btn btn-default" type="button" onclick="history.go(-1);window.close();">Back</button>
</div>
<div class="" id="report-container">
	<div class=" page" id="report-page-1">
		<div class="" id="summary">
			<div class="" id="header">
				<div id="up-block">
					<img id="up-seal" src="<?php echo base_url('assets/img/up-seal-bw.jpg')?>" alt="UP Seal">
					<p><strong><?php echo $office?></strong></p>
					<p>University of the Philippines Cebu</p>
					<p>Lahug, Cebu City</p>
				</div>
				<div id="title">
					<p><strong>TEACHING PERFORMANCE EVALUATION REPORT</strong></p>
				</div>
			</div>
			<div class="" id="summary-content">
				<div class="">
					<ol>
						<li>
							<label class="l1">Evaluators:</label>
							<span class="l1-value">Students</span>
						</li>
						<li>
							<label class="l1">Tool:</label>
							<span class="l1-value">Faculty Evaluation Instrument</span>
						</li>
						<ol class="l2-list">
							<li>
								<label class="l2"><?php echo reset($classes)->report['questions']['1']['a']['name']?></label>
								<span class="l2-value">70%</span>
							</li>
							<li>
								<label class="l2"><?php echo reset($classes)->report['questions']['1']['b']['name']?></label>
								<span class="l2-value">20%</span>
							</li>
							<li>
								<label class="l2"><?php echo reset($classes)->report['questions']['1']['c']['name']?></label>
								<span class="l2-value">5%</span>
							</li>
							<li>
								<label class="l2"><?php echo reset($classes)->report['questions']['1']['d']['name']?></label>
								<span class="l2-value">5%</span>
							</li>
						</ol>
						<li>
							<label>Quantitative/Qualitative Rating Scale</label>
						</li>
						<ol class="unstyled">
							<li>
								<label class="l2">1.49 and below</label>
								<span class="l2-value">Excellent</span>
							</li>
							<li>
								<label class="l2">1.50 - 2.49</label>
								<span class="l2-value">Very Good</span>
							</li>
							<li>
								<label class="l2">2.50 - 3.49</label>
								<span class="l2-value">Good</span>
							</li>
							<li>
								<label class="l2">3.50 - 4.49</label>
								<span class="l2-value">Conditional</span>
							</li>
							<li>
								<label class="l2">4.50 and above </label>
								<span class="l2-value">Poor</span>
							</li>
						</ol>
						<li>
							<label class="l3">Name of Faculty Member:</label>
							<span class="l3-value"><?php echo $teacher->last_name.', '.$teacher->first_name?></span>
						</li>
						<ol class="unstyled">
							<li>
								<label class="l2">Semester/Trimester:</label>
								<span class="l2-value"><?php echo format_semester(reset($classes)->semester)?></span>
							</li>
							<li>
								<label class="l2">A.Y.:</label>
								<span class="l2-value"><?php echo format_year(reset($classes)->year)?></span>
							</li>
						</ol>
					</ol>
				</div>
			</div>
		</div>

		<table class="table table-bordered eval-report-table">
				<tr>
					<th>Subject</th>
					<th>No. of Students</th>
					<th>Avrg. A</th>
					<th>Avrg. B</th>
					<th>Avrg. C</th>
					<th>Avrg. D</th>
					<th>Grand Avrg.</th>
					<th>Qualitative Rating</th>
				</tr>
<?php $sum_rating = 0;?>
<?php foreach($classes as $class):?>
				<tr>
					<td><?php echo $class->class_name.' '.$class->section?></td>
					<td><?php echo $class->number_of_students?></td>
					<td><?php echo format_rating($class->report['summary']['average']['a'])?></td>
					<td><?php echo format_rating($class->report['summary']['average']['b'])?></td>
					<td><?php echo format_rating($class->report['summary']['average']['c'])?></td>
					<td><?php echo format_rating($class->report['summary']['average']['d'])?></td>
					<td><strong><?php echo format_rating($class->report['summary']['average']['grand'])?></strong></td>
					<td><strong><?php echo $class->report['summary']['rating']?></strong></td>
				</tr>
<?php $sum_rating += $class->report['summary']['average']['grand'];?>
<?php endforeach;?>
<?php $average_rating = $sum_rating / count($classes);?>
		</table>
		<div class="average">
				<label class="average">Average Rating: <?php echo format_rating($average_rating)?></label>
				<label class="rating"><?php echo qualitative_rating($average_rating)?></label>
		</div>
		<div id="chair-signature">
			<div id="chair-name-container">
				<span id="chair-name">
				<?php if(!empty($chair)):?>
					<?php echo $chair->first_name.' '.$chair->last_name?>
				<?php else:?>
					<br>
				<?php endif;?>
				</span>
				<span id="underline">
					<br>
					____________________
				</span>
			</div>
			<br>
			<span id="office"><?php echo $office?></span><br>
			<span id="title">Chair</span><br>
			<span id="date">Date: _______________</span><br>
		</div>
	</div>

<?php foreach($classes as $class):?>
	<div class=" page" id="report-page-2">
		<div class="" id="summary">
			<div class="" id="summary-content">
				<div class="">
					<p><strong><?php echo $teacher->last_name.', '.$teacher->first_name?> - <?php echo $class->class_name.' '.$class->section?> (<?php echo format_semester($class->semester)?> Semester/Trimester | A.Y. <?php echo format_year($class->year)?>)</strong></p>
					<table class="table table-bordered eval-report-table">
							<tr>
								<th>Subject</th>
								<th>No. of Students</th>
								<th>Avrg. A</th>
								<th>Avrg. B</th>
								<th>Avrg. C</th>
								<th>Avrg. D</th>
								<th>Grand Avrg.</th>
								<th>Qualitative Rating</th>
							</tr>
							<tr>
								<td><?php echo $class->class_name.' '.$class->section?></td>
								<td><?php echo $class->number_of_students?></td>
								<td><?php echo format_rating($class->report['summary']['average']['a'])?></td>
								<td><?php echo format_rating($class->report['summary']['average']['b'])?></td>
								<td><?php echo format_rating($class->report['summary']['average']['c'])?></td>
								<td><?php echo format_rating($class->report['summary']['average']['d'])?></td>
								<td><strong><?php echo format_rating($class->report['summary']['average']['grand'])?></strong></td>
								<td><strong><?php echo $class->report['summary']['rating']?></strong></td>
							</tr>
					</table>
				</div>
			</div>
		</div>
		<div class=" detail" id="detail-1">
			<div class="" id="part-a">
				<p><strong>A. <?php echo $class->report['questions']['1']['a']['name']?></strong></p>
				<table class="table table-bordered eval-report-table">
					<tbody>
							<tr>
								<th>Question</th>
								<th>Average</th>
								<th></th>
							</tr>
						<?php for($i=1; $i <= 10; $i++):?>
							<tr>
								<td><?php echo $i.'. '.$class->report['questions']['1']['a']['content'][$i]?></td>
								<td><?php echo format_rating($class->report['detail'][$i])?></td>
								<td>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo format_percentage($class->report['detail'][$i])?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo format_percentage($class->report['detail'][$i])?>%;">
											
										</div>
									</div>
								</td>
							</tr>
						<?php endfor;?>
					</tbody>
				</table>
			</div>
			<div class="" id="part-b">
				<p><strong>B. <?php echo $class->report['questions']['1']['b']['name']?></strong></p>
				<table class="table table-bordered eval-report-table">
					<tbody>
							<tr>
								<th>Question</th>
								<th>Average</th>
								<th></th>
							</tr>
						<?php for($i=11; $i <= 20; $i++):?>
							<tr>
								<td><?php echo $i.'. '.$class->report['questions']['1']['b']['content'][$i]?></td>
								<td><?php echo format_rating($class->report['detail'][$i])?></td>
								<td>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo format_percentage($class->report['detail'][$i])?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo format_percentage($class->report['detail'][$i])?>%;">
											
										</div>
									</div>
								</td>
							</tr>
						<?php endfor;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class=" page" id="report-page-3">
		<div class="detail" id="detail-2">
			<div class="" id="part-c">
				<p><strong>C. <?php echo $class->report['questions']['1']['c']['name']?></strong></p>
				<table class="table table-bordered eval-report-table">
					<tbody>
							<tr>
								<th>Question</th>
								<th>Average</th>
								<th></th>
							</tr>
						<?php for($i=21; $i <= 30; $i++):?>
							<tr>
								<td><?php echo $i.'. '.$class->report['questions']['1']['c']['content'][$i]?></td>
								<td><?php echo format_rating($class->report['detail'][$i])?></td>
								<td>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo format_percentage($class->report['detail'][$i])?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo format_percentage($class->report['detail'][$i])?>%;">
											
										</div>
									</div>
								</td>
							</tr>
						<?php endfor;?>
					</tbody>
				</table>
			</div>
			<div class="" id="part-d">
				<p><strong>D. <?php echo $class->report['questions']['1']['d']['name']?></strong></p>
				<table class="table table-bordered eval-report-table">
					<tbody>
							<tr>
								<th>Question</th>
								<th>Average</th>
								<th></th>
							</tr>
						<?php for($i=31; $i <= 35; $i++):?>
							<tr>
								<td><?php echo $i.'. '.$class->report['questions']['1']['d']['content'][$i]?></td>
								<td><?php echo format_rating($class->report['detail'][$i])?></td>
								<td>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo format_percentage($class->report['detail'][$i])?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo format_percentage($class->report['detail'][$i])?>%;">
											
										</div>
									</div>
								</td>
							</tr>
						<?php endfor;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class=" page" id="report-page-4">
		<div class="" id="comment-1">
			<div class="comments" id="strong-points">
				<p><strong>Strong Points:</strong></p>
				<?php if(!empty($class->report['strong_points'])):?>
					<ol>
						<?php foreach($class->report['strong_points'] as $key => $comment):?>
							<?php if(!empty($comment)):?>
								<li>
									<?php echo $comment?>
								</li>
							<?php endif;?>
						<?php endforeach;?>
					</ol>
				<?php else:?>
					<p><i>No comments</i></p>
				<?php endif;?>
			</div>
			<div class="comments" id="weak-points">
				<p><strong>Weak Points:</strong></p>
				<?php if(!empty($class->report['weak_points'])):?>
					<ol>
						<?php foreach($class->report['weak_points'] as $key => $comment):?>
							<?php if(!empty($comment)):?>
								<li>
									<?php echo $comment?>
								</li>
							<?php endif;?>
						<?php endforeach;?>
					</ol>
				<?php else:?>
					<p><i>No comments</i></p>
				<?php endif;?>
			</div>
			<div class="comments" id="recommendations">
				<p><strong>Recommendations for Improvement:</strong></p>
				<?php if(!empty($class->report['recommendations'])):?>
					<ol>
						<?php foreach($class->report['recommendations'] as $key => $comment):?>
							<?php if(!empty($comment)):?>
								<li>
									<?php echo $comment?>
								</li>
							<?php endif;?>
						<?php endforeach;?>
					</ol>
				<?php else:?>
					<p><i>No comments</i></p>
				<?php endif;?>
			</div>
		</div>
	</div>

<?php if ($include_forms == TRUE):?>		
	<div id="report-page-5">
		<div class=" evaluation-forms">
			<?php for ($e_index = 0; $e_index < sizeof($class->report['evaluations']); $e_index+=2):?>
				<div class="eval-form-page">
					<div class="evaluation-form">
						<div class="header">
							<label><?php echo $class->report['evaluations'][$e_index]->date?></label>
							<ol class="unstyled">
								<li>
									<label class="eval-form-label">
										Teacher's Name:
									</label>
									<span class="eval-form-value"><?php echo $teacher->last_name.', '.$teacher->first_name?></span>
								</li>
								<li>
									<label class="eval-form-label">
										Subject/Section:
									</label>
									<span class="eval-form-value"><?php echo $class->class_name.' '.$class->section?></span>
								</li>
								<li>
									<label class="eval-form-label">
										Day/Time:
									</label>
									<span class="eval-form-value"><?php echo $class->schedule?></span>
								</li>
								<li>
									<label class="eval-form-label">
										Sem./School Yr.:
									</label>
									<span class="eval-form-value"><?php echo format_semester($class->semester).' Sem/A.Y. '.format_year($class->year)?></span>
								</li>
							</ol>
							<div class="title">
								<p><strong>FACULTY EVALUATION INSTRUMENT</strong></p>
							</div>
						</div>
						<div class="content">
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">I. A.</th>
										<th>E</th>
										<th>VG</th>
										<th>G</th>
										<th>F</th>
										<th>P</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 1; $i <= 10; $i++):?>
										<tr>
											<td class="no-border"><?php echo $i?>.</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 1) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 2) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 3) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 4) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 5) echo '&#9679;'?></strong>
											</td>
										</tr>
									<?php endfor;?>
								</tbody>
							</table>
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">B.</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 11; $i <= 20; $i++):?>
										<tr>
											<td class="no-border"><?php echo $i?>.</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 1) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 2) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 3) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 4) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 5) echo '&#9679;'?></strong>
											</td>
										</tr>
									<?php endfor;?>
								</tbody>
							</table>
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">C.</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 21; $i <= 30; $i++):?>
										<tr>
											<td class="no-border"><?php echo $i?>.</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 1) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 2) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 3) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 4) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 5) echo '&#9679;'?></strong>
											</td>
										</tr>
									<?php endfor;?>
								</tbody>
							</table>
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">D.</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 31; $i <= 35; $i++):?>
										<tr>
											<td class="no-border"><?php echo $i?>.</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 1) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 2) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 3) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 4) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index]->{'i'.$i} == 5) echo '&#9679;'?></strong>
											</td>
										</tr>
									<?php endfor;?>
								</tbody>
							</table>
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">II.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="no-border">36.</td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index]->i36 == 1) echo '5'?></td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index]->i36 == 2) echo '4'?></td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index]->i36 == 3) echo '3'?></td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index]->i36 == 4) echo '2'?></td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index]->i36 == 5) echo '1'?></td>
									</tr>
									</tbody>
							</table>
							<div class="comments">
								<label class="part3"><strong>III.</strong></label>
								<ol class="contents">
									<li class="strong_points">
										<label><strong><?php echo $class->report['questions']['3']['content']['1']?></strong></label>
										<span class="ellipsis"><?php echo $class->report['evaluations'][$e_index]->strong_points?>&nbsp;</span>
									</li>
									<li class="weak_points">
										<label><strong><?php echo $class->report['questions']['3']['content']['2']?></strong></label>
										<span class="ellipsis"><?php echo $class->report['evaluations'][$e_index]->weak_points?>&nbsp;</span>
									</li>
									<li class="recommendations">
										<label><strong><?php echo $class->report['questions']['3']['content']['3']?></strong></label>
										<span class="ellipsis"><?php echo $class->report['evaluations'][$e_index]->recommendations?>&nbsp;</span>
									</li>
								</ol>
							</div>
						</div>
					</div>
					<?php if (!empty($class->report['evaluations'][$e_index+1])):?>
					<div class="evaluation-form">
						<div class="header">
							<label><?php echo $class->report['evaluations'][$e_index+1]->date?></label>
							<ol class="unstyled">
								<li>
									<label class="eval-form-label">
										Teacher's Name:
									</label>
									<span class="eval-form-value"><?php echo $teacher->last_name.', '.$teacher->first_name?></span>
								</li>
								<li>
									<label class="eval-form-label">
										Subject/Section:
									</label>
									<span class="eval-form-value"><?php echo $class->class_name.' '.$class->section?></span>
								</li>
								<li>
									<label class="eval-form-label">
										Day/Time:
									</label>
									<span class="eval-form-value"><?php echo $class->schedule?></span>
								</li>
								<li>
									<label class="eval-form-label">
										Sem./School Yr.:
									</label>
									<span class="eval-form-value"><?php echo format_semester($class->semester).' Sem/A.Y. '.format_year($class->year)?></span>
								</li>
							</ol>
							<div class="title">
								<p><strong>FACULTY EVALUATION INSTRUMENT</strong></p>
							</div>
						</div>
						<div class="content">
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">I. A.</th>
										<th>E</th>
										<th>VG</th>
										<th>G</th>
										<th>F</th>
										<th>P</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 1; $i <= 10; $i++):?>
										<tr>
											<td class="no-border"><?php echo $i?>.</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 1) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 2) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 3) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 4) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 5) echo '&#9679;'?></strong>
											</td>
										</tr>
									<?php endfor;?>
								</tbody>
							</table>
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">B.</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 11; $i <= 20; $i++):?>
										<tr>
											<td class="no-border"><?php echo $i?>.</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 1) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 2) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 3) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 4) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 5) echo '&#9679;'?></strong>
											</td>
										</tr>
									<?php endfor;?>
								</tbody>
							</table>
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">C.</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 21; $i <= 30; $i++):?>
										<tr>
											<td class="no-border"><?php echo $i?>.</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 1) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 2) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 3) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 4) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 5) echo '&#9679;'?></strong>
											</td>
										</tr>
									<?php endfor;?>
								</tbody>
							</table>
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">D.</th>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 31; $i <= 35; $i++):?>
										<tr>
											<td class="no-border"><?php echo $i?>.</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 1) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 2) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 3) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 4) echo '&#9679;'?></strong>
											</td>
											<td class="check-td">
												<strong><?php if ($class->report['evaluations'][$e_index+1]->{'i'.$i} == 5) echo '&#9679;'?></strong>
											</td>
										</tr>
									<?php endfor;?>
								</tbody>
							</table>
							<table class="eval-form-table">
								<thead>
									<tr>
										<th class="no-border">II.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="no-border">36.</td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index+1]->i36 == 1) echo '5'?></td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index+1]->i36 == 2) echo '4'?></td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index+1]->i36 == 3) echo '3'?></td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index+1]->i36 == 4) echo '2'?></td>
										<td class="check-td"><?php if ($class->report['evaluations'][$e_index+1]->i36 == 5) echo '1'?></td>
									</tr>
									</tbody>
							</table>
							<div class="comments">
								<label class="part3"><strong>III.</strong></label>
								<ol class="contents">
									<li class="strong_points">
										<label><strong><?php echo $class->report['questions']['3']['content']['1']?></strong></label>
										<span class="ellipsis"><?php echo $class->report['evaluations'][$e_index+1]->strong_points?>&nbsp;</span>
									</li>
									<li class="weak_points">
										<label><strong><?php echo $class->report['questions']['3']['content']['2']?></strong></label>
										<span class="ellipsis"><?php echo $class->report['evaluations'][$e_index+1]->weak_points?>&nbsp;</span>
									</li>
									<li class="recommendations">
										<label><strong><?php echo $class->report['questions']['3']['content']['3']?></strong></label>
										<span class="ellipsis"><?php echo $class->report['evaluations'][$e_index+1]->recommendations?>&nbsp;</span>
									</li>
								</ol>
							</div>
						</div>
					</div>
					<?php endif;?>
				</div>
			<?php endfor;?>
		</div>
	</div>
<?php endif;?>
<?php endforeach;?>
</div>