<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
use Elementor\Utils;
extract($data);
?>

<div class="rt-pricing-section--style-1 pricing-wrapper rt-switcher-pricing-section">
  <div class="row justify-content-center text-center">
      <div class="col-xl-8 col-lg-9">
          <div class="rt-pricing-box-title-wrapper">
            <div class="rt-pricing-switch-wrapper">
              <div class="price-switch-box price-switch-box--style-1">
                <span class="pack-name"><?php echo wp_kses_post($data['monthly_title']); ?></span>
                <div class="pricing-switch-container">
                  <div class="pricing-switch"></div>
                  <div class="pricing-switch pricing-switch-active"></div>
                  <div class="switch-button"></div>
                </div>
                <span class="pack-name"><?php echo wp_kses_post($data['yearly_title']); ?></span>
              </div>
            </div>
          </div>
      </div>
  </div>
  <div class="rt-tab-content" id="myTabContent">
      <div class="rt-tab-pane rtTabFadeInUp monthly">
      <?php if($data['monthly_features']){ ?>
        <div class="row g-4 justify-content-center">
            <?php foreach($data['monthly_features'] as $key=>$feature){ ?>
              
            <div class="col-lg-4  col-md-6">
              <div class="rt-pricing-table">
                <h3 class="rt-pricing-table__plan-name"><?php echo wp_kses_post($feature['title']); ?></h3>
                <div class="rt-pricing-table__item-price">
                    <h4><?php echo wp_kses_post($feature['price']); ?><sub><?php echo wp_kses_post($feature['price_suffix']); ?></sub></h4>
                </div>
                <div class="rt-pricing-table__content">
                    <?php echo wp_kses_post($feature['content']); ?>
                </div>
                <div class="rt-pricing-table__footer">
                    <?php if($feature['btn_text']){ ?>
                        <a href="<?php echo esc_attr($feature['btn_url']['url']); ?>" class="rt-btn-style" target="_blank">
                        <span>
                          <?php echo wp_kses_post($feature['btn_text']); ?>
                        
                        </span></a>
                    <?php } ?>
                </div>
              </div>
            </div>
          <!-- end col -->
          <?php } ?>
        </div>
        <?php } ?>
        <!-- end row -->
      </div>
      <div class="rt-tab-pane rtTabFadeInUp yearly">
      <?php if($data['yearly_features']){ ?>
        <div class="row g-4 justify-content-center">
        <?php foreach($data['yearly_features'] as $key=>$yearly_feature){ ?>
          
          <div class="col-lg-4 col-md-6">
            <div class="rt-pricing-table">
               <h3 class="rt-pricing-table__plan-name"><?php echo wp_kses_post($yearly_feature['yearly_title']); ?></h3>
               <div class="rt-pricing-table__item-price">
                   <h4><?php echo wp_kses_post($yearly_feature['yearly_price']); ?><sub><?php echo wp_kses_post($yearly_feature['yearly_price_suffix']); ?></sub></h4>
              </div>
              <div class="rt-pricing-table__content">
                  <?php echo wp_kses_post($yearly_feature['yearly_content']); ?>
              </div>
              
              <div class="rt-pricing-table__footer">
                  <?php if($yearly_feature['yearly_btn_text']){ ?>
                        <a href="<?php echo esc_attr($yearly_feature['yearly_btn_url']['url']); ?>" class="rt-btn-style" target="_blank">
                        <span>
                          <?php echo wp_kses_post($yearly_feature['yearly_btn_text']); ?>
                        </span></a>
                    <?php } ?>
              </div>
            </div>
          </div>
          <!-- end col -->
          <?php } ?>
        </div>
        <!-- end row -->
        <?php } ?>
      </div>
  </div>
</div>