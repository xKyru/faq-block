<?php 

/* FAQ Block */ 

if(!get_field('toggle_block')){
    return;
}

$allowed_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'span', 'p');

$title_tag = get_field('title_tag');
$title_tag = in_array($title_tag, $allowed_tags, true) ? $title_tag : 'h2';

$question_tag = get_field('questions_tag');
$question_tag = in_array($question_tag, $allowed_tags, true) ? $question_tag : 'h3';

$title = get_field('title');
$body = get_field('body_content');
$image = get_field('image');
?>

<section class="section faq">
    <div class="faq__card">
        <div class="faq__intro">
            <?php if($title) : ?> 
                <<?php echo esc_attr($title_tag); ?> class="faq__title">
                    <?php echo esc_html($title); ?>
                </<?php echo esc_attr($title_tag); ?>>                    
            <?php endif; ?>

            <?php if($body): ?>
                <div class="faq__body">
                    <?php echo wp_kses_post($body); ?>
                </div>
            <?php endif; ?>

            <?php if(is_array($image) && !empty($image['url'])) : ?>
                <img 
                    class="faq__image" 
                    src="<?php echo esc_url($image['url']);?>"
                    alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                >
            <?php endif; ?>
        </div>
        
        <?php if(have_rows('faqs')) : ?>
            <div class="faq__list">

                <?php while(have_rows('faqs')): 
                    the_row();

                    $question = get_sub_field('question');
                    $answer = get_sub_field('answer');

                    if(!$question){
                        continue;
                    }
                    ?>
                    <details class="faq__item">
                        <summary>
                            <<?php echo esc_attr($question_tag); ?> class="faq__question">
                            <?php echo esc_html($question); ?>
                            </<?php echo esc_attr($question_tag); ?>>
                            <span class="faq__icon" aria-hidden="true"></span>
                        </summary>
                        <?php if($answer) : ?>
                            <div class="faq__answer">
                                <?php echo wp_kses_post($answer); ?>
                            </div>
                        <?php endif ?>
                    </details>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>