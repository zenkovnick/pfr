<?php include_partial("home/error"); ?>
<?php include_partial("home/notice"); ?>
<?php include_partial('home/success'); ?>

<?php slot('title', "The Solution - Media") ?>
<?php slot('header_avatar', " ") ?>

<div class="ribbon">
    <div class="wrapper">
        <h1>
            <!-- <span class="ribbon-arrow"></span> -->
            <span class="left-span"></span>
            <span class="right-span"></span>
            “America, Let's Fix the ROOT Problem.“
        </h1>
    </div>
</div>
<div class="wrapper media">
    <h1>Media</h1>

    <div class="media-wrapper">
        <div class="media-left">
            <p>For further information, please feel free to contact Rick Raddatz directly via either his land-line <strong>303-949-8075</strong> or mobile <strong>303-720-9913</strong>.
            <p>You can also reach him via e-mail at <a class="mail" href="mailto:Rick@TheSolution.org">Rick@TheSolution.org</a>.</p>
            <h3>Press Release</h3>
            <ul class="other-resources">
                <li>
                    <span class="icon-doc"></span>
                    <a href="<?php echo url_for('@save_file?filename=TheSolution-NPS-PressRelease&ext=docx') ?>">
                        New Poll: 75% Say Congress Should Publish a Prioritized Budget</a>
                    <span class="size">23 kB</span>
                </li>
                <li>
                    <span class="icon-pdf"></span>
                    <a href="<?php echo url_for('@save_file?filename=TheSolution-PollResults&ext=pdf') ?>">Poll Summary</a>
                    <span class="size">49 kB</span>
                </li>
                <li>
                    <span class="icon-pdf"></span>
                    <a href="<?php echo url_for('@save_file?filename=TheSolution-PollData&ext=pdf') ?>">Poll Details</a>
                    <span class="size">118 kB</span>
                </li>
            </ul>
            <h3>Other Resources</h3>
            <ul class="other-resources">
                <li>
                    <span class="icon-pdf"></span>
                    <a href="<?php echo url_for('@save_file?filename=TheSolution-Cap-and-prioritize&ext=pdf') ?>">Cap-and-Prioritize One-Page Summary</a>
                    <span class="size">347 kB</span>
                </li>
                <li>
                    <span class="icon-pdf"></span>
                    <a href="<?php echo url_for('@save_file?filename=TheSolution-The-bell-curve&ext=pdf') ?>">Cap-and-Prioritize Chart</a>
                    <span class="size">370 kB</span>
                </li>
                <li>
                    <span class="icon-pdf"></span>
                    <a href="<?php echo url_for('@save_file?filename=TheSolution-OnePageSummary&ext=pdf') ?>">The Philosophy Behind the Solution - One-Page Summary</a>
                    <span class="size">301 kB</span>
                </li>

                <li>
                    <span class="icon-pdf"></span>
                    <a href="<?php echo url_for('@save_file?filename=TheSolution-NPS-Table&ext=pdf') ?>">The Philosophy Behind the Solution - Table Version</a>
                    <span class="size">347 kB</span>
                </li>
            </ul>
        </div>
        <div class="media-right">
            <span>Click on photo to download it in high resolution</span>
            <div class="media-photo">
                <a href="<?php echo url_for('@save_file?filename=TheSolutionRickRaddatz2&ext=jpg') ?>">
                    <img src="/images/media_rick_1.jpg">
                </a>
                <span>4928x3264 1.7mB</span>
            </div>
            <div class="media-photo">
                <a href="<?php echo url_for('@save_file?filename=TheSolutionRickRaddatz1&ext=jpg') ?>">
                    <img src="/images/media_rick_2.jpg">
                </a>
                <span>2400x3000 738kB</span>
            </div>
        </div>
    </div>

</div>