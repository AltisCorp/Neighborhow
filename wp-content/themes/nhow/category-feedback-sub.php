<?php get_header(); ?>
<div class="row-fluid row-breadcrumbs">
	<div id="nhbreadcrumb">
<?php nhow_breadcrumb(); ?>
	</div>
</div>
<?php
$cat = get_the_category();
$cat_name = $cat[0]->name;
if ($cat_name == "Content Suggestions") {
	$cat_name = 'Content';
}
elseif ($cat_name == "Feature Ideas") {
	$cat_name = 'Features';
}
?>
<div class="row-fluid row-content">	
	<div class="wrapper">
		<div id="main">			
			<div id="content">
				<h3 class="page-title">Neighborhow Feedback &#8212; <?php echo $cat_name;?></h3>
				<div class="intro-block">Help make Neighborhow better by telling us about the content and features you want.<p>Voting on ideas and questions from other people is a good way to help us understand what&#39;s most important to you. But if you don&#39;t see your idea on the list, go ahead and add your own feedback!</p></div>
					
				<div id="list-feedback">
					<div class="intro-block-button"><a id="addfdbk" class="nh-btn-green" href="<?php echo $app_url;?>/add-feedback" rel="tooltip" data-placement="bottom" data-title="<strong>Please sign in before adding feedback.</strong>">Add Feedback</a></div>
					<ul class="list-feedback">	

<?php 
	$fdbk_sub_cat = get_cat_ID($cat[0]->name);
	$vote_sub_args = array(
		'post_status' => 'publish',
		'cat' => $fdbk_sub_cat,
		'orderby' => 'meta_value_num',
		'order' => DESC,
		'meta_key' => '_nh_vote_count'
	);
	$fdbk_sub_query = new WP_Query($vote_sub_args);	
		
	if (!$fdbk_sub_query->have_posts()) : ?>
		<li>Looks like there&#39;s no feedback in this category yet. Add your ideas or questions!</li>
<?php else: ?>
<?php while($fdbk_sub_query->have_posts()) : $fdbk_sub_query->the_post();?>
		
			<li class="list-vote" id="post-<?php echo $post->ID; ?>">
				<div class="vote-btn">
<?php 
if (nh_user_has_voted_post($current_user->ID, $post->ID)) {
	echo '<span class="byline"><a id="votedthis" title="See your other Votes" href="'.$app_url.'/author/'.$current_user->user_login.'" class="votedthis nhline">You voted</a></span>';
}
else {
	nh_vote_it_link();
}							
?>
				</div>
				<div class="vote-question"><strong><a href="<?php the_permalink();?>" title="View <?php echo the_title();?>"><?php the_title();?></a></strong>
					<p class="comment-meta"><span class="byline"><?php comments_number( '', '1 comment', '% comments' ); ?></span></p>
					<p class="comment-meta"><span class="byline">in </span>
<?php 
$category = get_the_category(); 
foreach ($category as $cat) {
	echo '<a href="'.$app_url.'/feedback/'.$cat->slug.'" title="View feedback in '.$cat->name.'">';
	echo $cat->name;
	echo '</a>';
}
?>
					</p>													
				</div>
				<div class="nh-vote-count"><span class="nh-vote-count  vote-<?php echo $post->ID;?>">
<?php echo nh_get_vote_count($post->ID);?></span>
<br/><span class="small-vote">votes</span>
				</div>						
			</li>
<?php endwhile; ?>		
<?php endif;
wp_reset_query(); ?>								
		</ul>			
					</div><!-- / list-feedback-->
			</div><!--/ content-->
<?php get_sidebar('feedback');?>
		</div><!--/ main-->
	</div><!--/ content-->
</div><!--/ row-content-->
<?php get_footer(); ?>