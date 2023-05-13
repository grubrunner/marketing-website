<?php

class WPM2AWS_WelcomePanel
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'loadAdminMenu'), 9);
    }

    public static function template()
    {
        $licenceType = get_option('wpm2aws_valid_licence_type');
        ?>
        <div id="welcome-panel" class="wpm2aws-welcome-panel">
            <?php wp_nonce_field('wpm2aws-welcome-panel-nonce', 'welcomepanelnonce', false); ?>

            <div class="wpm2aws-welcome-panel-content">
                <div class="wpm2aws-welcome-panel-column-container">

                    <div style="max-width:10%;" class="wpm2aws-welcome-panel-column  wpm2aws-welcome-panel-first">

                        <p>
                            <img style="max-width:90%;"
                                 alt="Powered by AWS image"
                                 src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/images/aws-welcome-image.png"/>
                        </p>

                    </div>

                    <div style="max-width:25%;border-left:1px solid #d2d2d2;padding-left:25px; margin-top:8px;"
                         class="wpm2aws-welcome-panel-column  wpm2aws-welcome-panel-middle">

                        <?php
                        if ('self-managed' === $licenceType) {
                            echo self::makeSelfManagedColumnOne();
                        } else {
                            echo self::makeStandardColumnOne();
                        }
                        ?>

                    </div>

                    <div style="max-width:25%;border-left:1px solid #d2d2d2;padding-left:25px; margin-top:8px;"
                         class="wpm2aws-welcome-panel-column  wpm2aws-welcome-panel-last">

                        <?php
                        if ('self-managed' === $licenceType) {
                            echo self::makeSelfManagedColumnTwo();
                        } else {
                            echo self::makeStandardColumnTwo();
                        }
                        ?>

                    </div>

                    <?php
                    if ('self-managed' === $licenceType) { ?>
                        <div style="max-width:25%;border-left:1px solid #d2d2d2;padding-left:25px; margin-top:8px;"
                             class="wpm2aws-welcome-panel-column  wpm2aws-welcome-panel-last">

                            <?php echo self::makeSelfManagedColumnThree();?>

                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <?php
    }

    /**
     * @return string
     */
    private static function makeStandardColumnOne()
    {
        $licenceKey = get_option('wpm2aws_licence_key');
        $html = '';

        $html .= self::makeColumnHeading('WP on AWS v.' . WPM2AWS_VERSION);

        // What is it?
        $itemText = 'What is it and %1$s';
        $linkUrl = sprintf( '%s/how-does-it-work/', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'how does it work?';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        // Get a trial licence
        if (false === $licenceKey || '' === $licenceKey) {
            $itemText = '%1$s to clone a site to AWS Now.';
            $linkUrl = sprintf( '%s/checkout?edd_action=add_to_cart&download_id=8272/', WPM2AWS_SEAHORSE_WEBSITE_URL);
            $linkText = 'Get Credentials';
            $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

            return $html;
        }

        // Pricing options    
        $itemText = 'View our %1$s.';
        $linkUrl = sprintf( '%s/pricing', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'Plan Options';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        return $html;
    }

    /**
     * @return string
     */
    private static function makeStandardColumnTwo()
    {
        $html = '';

        $html .= self::makeColumnHeading('Help & Support');

        // Self Paced Labs
        $itemText = '%1$s for AWS self-paced lab.';
        $linkUrl = sprintf( '%s/migrating-and-managing-a-wordpress-website-with-amazon-lightsail/', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'Click Here';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        // Seahorse Support
        $itemText = '%1$s for Seahorse Support';
        $linkUrl = sprintf( '%s/wp-on-aws-support-portal/', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'Click Here';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        return $html;
    }

    /**
     * @return string
     */
    private static function makeSelfManagedColumnOne()
    {
        $html = '';

        $html .= self::makeColumnHeading('User Guides v.' . WPM2AWS_VERSION);

        // Migration User Guide
        $itemText = '%1$s for our migration user guide.';
        $linkUrl = sprintf( '%s/migrating-and-managing-wordpress-with-amazon-lightsail-self-manage/', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'Click Here';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        // Staging User Guide
        $itemText = '%1$s for our create staging user guide.';
        $linkUrl = sprintf( '%s/how-to-quickly-and-easily-create-staging-development-sites-self-manage/', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'Click Here';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        return $html;

    }

    /**
     * @return string
     */
    private static function makeSelfManagedColumnTwo()
    {
        $html = '';

        $html .= self::makeColumnHeading('Useful Links');

        // CLI User Guide
        $itemText = '%1$s for CLI user guide';
        $linkUrl = sprintf( '%s/wordpress-developers-working-with-the-aws-lightsail-terminal-here-are-a-few-commands-that-may-be-useful-new/', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'Click Here';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        // Bitnami Resources
        $itemText = '%1$s for Bitnami external resources';
        $linkUrl = 'https://docs.bitnami.com/aws/get-started-lightsail/';
        $linkText = 'Click Here';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        return $html;
    }

    /**
     * @return string
     */
    private static function makeSelfManagedColumnThree()
    {
        $html = '';

        $html .= self::makeColumnHeading('Help & Support');

        // FAQs
        $itemText = '%1$s for FAQ\'s';
        $linkUrl = sprintf( '%s/faqs/', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'Click Here';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        // Seahorse Support
        $itemText = '%1$s for Seahorse Support';
        $linkUrl = sprintf( '%s/wp-on-aws-support-portal/', WPM2AWS_SEAHORSE_WEBSITE_URL);
        $linkText = 'Click Here';
        $html .= self::makeWelcomeColumnItem($itemText, $linkUrl, $linkText);

        return $html;
    }

    /**
     * @param $headingText
     * @return string
     */
    private static function makeColumnHeading($headingText)
    {
        $html = '';

        $html .= '<h3>';
        $html .= esc_html(__($headingText, 'migration-2-aws'));
        $html .= '</h3>';

        return $html;
    }

    /**
     * @param $itemString
     * @param $itemLinkUrl
     * @param $linkText
     * @param $target
     * @return string
     */
    private static function makeWelcomeColumnItem($itemString, $itemLinkUrl, $linkText, $target = '_blank')
    {
        // translators: links labeled 1: 'Migrate2AWS.com'

        $html = '';

        $html .= '<p>';
        $html .= sprintf(
            esc_html(
                __(
                    $itemString,
                    'migration-2-aws'
                )
            ),
            wpm2awsHtmlLink(
                __(
                    $itemLinkUrl,
                    'migration-2-aws'
                ),
                __(
                    $linkText,
                    'migration-2-aws'
                ),
                true,
                array('target' => $target)
            )
        );

        $html .= '</p>';

        return $html;
    }
}
