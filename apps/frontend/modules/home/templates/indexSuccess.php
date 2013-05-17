<?php slot('header_avatar'); ?>
    <?php echo " " ?>
<?php end_slot() ?>
<?php include_partial("home/error"); ?>
<?php include_partial('home/notice'); ?>
<?php include_partial('home/success'); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js"></script>

<div class="ribbon">
    <div class="wrapper">
        <h1>
            <!-- <span class="ribbon-arrow"></span> -->
            <span class="left-span"></span>
            <span class="right-span"></span>
            “America, Let's Solve the ROOT Problem.“
        </h1>
    </div>
</div>


<?php if($referal_id): ?>
    <?php slot('media_link', link_to('Media', "@referal_media?referal_id={$referal_id}")); ?>
<?php endif ?>


    <div class="video-block">
        <div class="wrapper home">
            <span class="video-right-shadow"></span>
            <div class="video-wrapper">
                <div id="video"></div>
                <span class="video-bottom-shadow"></span>
            </div>
            <div class="petition-signup">
                <span class="left-arrow"></span>
                <span class="first-line">After Watching</span><br />
                <span class="second-line">the Video, Please</span><br />
                <span class="third-line">SIGN THIS</span>
                <span class="petition">Petition</span>
                <span class="right-arrow"></span>
                <div class="petition-form">
                    <p>"I AGREE! It is time to fix government incentives and fix them right. I want <br /> to see THESOLUTION in the national debate."</p>
                    <?php if(is_null($referal_id)): ?>
                        <form name="<?php echo($form->getName()) ?>" method="post" action="<?php echo url_for("@registration?ref_action=share_event") ?>" >
                    <?php else: ?>
                        <form name="<?php echo($form->getName()) ?>" method="post" action="<?php echo url_for("@referal_registration?referal_id={$referal_id}&ref_action=share_event") ?>" >
                    <?php endif ?>
                            <?php include_partial('home/form', array('form' => $form)) ?>
                            <input type="hidden" name="from_home" id="from_home" value="1" />
                            <button type="submit">Submit</button>
                        </form>
                </div>
            </div>
            <p class="privacy">Privacy Policy: We will never sell, rent or share your personal info with anyone for
                any reason.</p>
        </div>
    </div>
    <div class="wrapper">
        <div class='testimonials'>
            <h2>Here's What Others are Saying About <span class="the-solution">The<span>Solution</span></span> </h2>
            <a href="<?php echo url_for('@add_testimonial_form') ?>" class='btn btn-grey fancy'>Add Your Testimonial</a>
            <div class="hidden">
                <p>The Solution - Be Part of the Solution. America, Let's Fix the ROOT problem!</p>
            </div>
            <div class="single-testimonial">
                <p>Sounds like the best solution to the crisis we are facing as a nation</p>
                <span class="author"> Judy L, <span class="independent">INDEPENDENT</span> from Quincy, MA</span>
            </div>
            <div class="single-testimonial">
                <p>It reminds me of the way a parent would solve a conflict between two fighting children, the children being the left and the right. The talk seems to be an application of admirable Principles that we can all recognize and agree on. Maybe that's where philosophy and worldview will come into play, and I have the greatest hope and admiration for the effort. If possible, I plan to be a part of the solution as we all do have a role to play and to take our responsibility. (You don't have a choice for my political view which is Constitutional conservative.)</p>
                <span class="author">Helen Kashiwa, <span class="independent">INDEPENDENT</span> from Houston</span>
            </div>
            <div class="single-testimonial">
                <p>I support the Solution. I believe the Solution can bring collaboration into making decisions that will better serve all the citizens of this country.</p>
                <span class="author">Juleen Stenzel, <span class="democrat">DEMOCRAT</span> from Rancho Cordova, CA</span>
            </div>
            <div class="single-testimonial">
                <p>What a great message to bring both "wings" together to help America take flight. Everyone should catch wind of this revolution!</p>
                <span class="author">Bill, <span class="republican">REPUBLICAN</span> from Northern Virginia</span>
            </div>
            <div class="single-testimonial">
                <p>We cannot afford to continue doing the same things, thinking the same way and holding on what we believe in all the time as if the world and its people are static...We do share almost certain common basic needs in life,, Life with hope, security and life without much hurt, despair or deprivation. We all share the concept of life and death , we all have one life but our differences in thinking has been perversely used by some few to hurt and deprive others. The majority of world populations are led by opinions of few, the opinion makers seem to no longer occupy that middle space to represent the majority, the opinion leaders have become so powerful to deal with and are richer and more resourced to disable the opinion makers. THE SOLUTION IS A GOOD NEW WAY FO WORKING AS IT EMPOWERS ALL WITH LESS COSTS: But it can only work if we understand it better through compassion marketing and building roads among our entrenched narrow vision and inflexible view of the world. As a British-African , this can end starvation and abject poverty IN AFRICA as well as checking the excess powers held by DESPOTS:: This might be a solution to mass migration from poor countries which are well resourced!!!!</p>
                <span class="author">Masembe--Nkata, <span class="progressive">PROGRESSIVE</span> from Humburg</span>
            </div>
            <div class="single-testimonial">
                <p>I think it is a great idea to put aside ideology which interferes with the process of accessing and hearing new ideas! Long overdue. </p>
                <span class="author">Wayne Nash, <span class="independent">INDEPENDENT</span> from Japan</span>
            </div>
            <div class="single-testimonial">
                <p>Don't know enough about it to support it or not support it. One thing I thought was missing was having a surplus to save for a rainy day, such as Katrina. Why do we have to spend everything that comes in when we should remember there are times when emergencies arise. I never see this little piece of the pie mentioned.</p>
                <span class="author">Shirley Kein, <span class="independent">INDEPENDENT</span> from Florida</span>
            </div>
            <div class="single-testimonial">
                <p>There is an Armenian saying which goes like this, "You can't get a strait line using a crooked ruler." So let's not keep trying over and over agin. We need a new RULER.</p>
                <span class="author">Rev. Fr. Vahan Gosdanian, <span class="independent">INDEPENDENT</span> from Fresno, California</span>
            </div>
            <div class="single-testimonial">
                <p>AWESOME Concept! I like idea of ALL parties getting together in a forum & finally discussing their points of view. I believe we can all work together to heal our American Political System!</p>
                <span class="author">Brie, <span class="independent">INDEPENDENT</span> from Washington, DC</span>
            </div>
            <div class="single-testimonial">
                <p>It will work for everyone. Not, "Who is right, but what is right"!</p>
                <span class="author">U.L. GUTIERREZ, <span class="republican">REPUBLICAN</span> from SAN ANTONIO, TEXAS</span>
            </div>
            <div class="single-testimonial">
                <p>The structure it has been formed I like most</p>
                <span class="author">Radha Krishnan, <span class="democrat">DEMOCRAT</span> from India/Kerala</span>
            </div>
            <div class="single-testimonial">
                <p>I support this.We need change for the average person.</p>
                <span class="author">John Duesing, <span class="independent">INDEPENDENT</span> from Patchogue N.Y.</span>
            </div>
            <div class="single-testimonial">
                <p>ITS NEED OF THE HOUR </p>
                <span class="author">Anand, <span class="progressive">PROGRESSIVE</span> from Mumbai / India</span>
            </div>
            <div class="single-testimonial">
                <p>Finally a government that would actually be for the people instead of the polititions! I am so tired of the fighting and the childishness of those in Washington with their "If you don't give me what I want, you can't have what you want" attitude. It's time to start working for the good of the country before it's too late!</p>
                <span class="author">Chris , <span class="republican">REPUBLICAN</span> from Toledo, Ohio</span>
            </div>
            <div class="single-testimonial">
                <p>In this time of political insanity this is a refreshing approach to establishing credibility in government.</p>
                <span class="author">Kavanaugh Farr, <span class="republican">REPUBLICAN</span> from River Ridge, La</span>
            </div>
            <div class="single-testimonial">
                <p>We need some way to overcome the ideological split that cripples our government and divides our citizens. The Solution is worth exploring to see if it can truly unite us without some external enemy to fight against. </p>
                <span class="author">Kendall Taylor, <span class="independent">INDEPENDENT</span> from POwder Springs, GA</span>
            </div>
            <div class="single-testimonial">
                <p>Great idea but will the American people follow through? It definitely supports both sides of the political spectrum, but will government honestly support transparency. All we can do is try and that's what I will do.</p>
                <span class="author">Michael Yoder, <span class="independent">INDEPENDENT</span> from Philomath, OR</span>
            </div>
            <div class="single-testimonial">
                <p>This is an incredible program....One that I highly recommend everyone get involved in....with the Solution there would be no more of that polarizing politics that we have all come to hate….it has something for everyone….Finally something that makes sense for the world that we live in today. </p>
                <span class="author">David Kasmier, <span class="democrat">DEMOCRAT</span> from Cleveland, Ohio</span>
            </div>
            <div class="single-testimonial">
                <p>We need to spend very much less on defence, spend more on eduation, health, security, welfare and such other measures so as to endear all persons in the country. we have wasted our precious lives, resources in two world wars. Let us now declare 'no more conflicts/wars'. we take the next generation to peace and peaceful co-existence.</p>
                <span class="author">Nagaraja M, <span class="progressive">PROGRESSIVE</span> from Bangalore/India</span>
            </div>
            <div class="single-testimonial">
                <p>I'm willing to support and see if in fact there is a progress element possible in our country. My children have asked if a world power can last longer than 200 years or if they have to spend their lives in the decline years. </p>
                <span class="author">Patrick Munson MD, <span class="independent">INDEPENDENT</span> from Ann Arbor/Mi</span>
            </div>
            <div class="single-testimonial">
                <p>I have long believed the world needs a peaceful revolution, we can not go on as we are. Its time for ordinary people to be heard. This could be the answer? </p>
                <span class="author">David Guy, <span class="independent">INDEPENDENT</span> from Gloucestershire. England</span>
            </div>
            <div class="single-testimonial">
                <p>TO LIVE, WORK FOR YOURSELF AND HELP THE DOWN TRODDEN SHOULD BE THE SLOGAN OF ANY POLITICAL PARTY. I DO APPRECIATE THEM VIEWS OF THE SOLUTION. </p>
                <span class="author">SUBBARAO KAKARLA, <span class="progressive">PROGRESSIVE</span> from HYDERABAD, A.P.</span>
            </div>
            <div class="single-testimonial">
                <p>This is great. Something for everyone.</p>
                <span class="author">Rachael A Gregory, <span class="progressive">PROGRESSIVE</span> from Dallas Texas</span>
            </div>
            <div class="single-testimonial">
                <p>Whether it is an autocrat's rule or Democracy the rulers are at the expense of the entire people but even in so called Democracy we see that the they are in power they forget the people.Though the Democratic set up is comparatively better NOW THERE IS NO COMPLETE control over the elected people's representative once in power.Hence some serious alternative to bring them under the control of the people must be done .Severe punishment should be given to the corrupt.Misuse of power should be guarded-Venu ,TIKKOTI,Kerala India </p>
                <span class="author">VENU, <span class="democrat">DEMOCRAT</span> from kozhikode ,Kerala</span>
            </div>
            <div class="single-testimonial">
                <p>The only problem is that the left ( the politicians, not the public) only act like they want to help others. They only want bigger government to make everyone dependent on them. They are against the private sector and free markets.</p>
                <span class="author">Billy, <span class="republican">REPUBLICAN</span> from Lexington, Ky</span>
            </div>
            <div class="single-testimonial">
                <p>Rick sounds like a great program and it would eliminate greed and back room deals, it would make the goverment have to answere for the money that they spend.</p>
                <span class="author">Ron , <span class="republican">REPUBLICAN</span> from Paola, KS</span>
            </div>
            <div class="single-testimonial">
                <p>Hey Rick, WOW! Extremely well thought out. 2 Questions come up for me... #1: Who's to decide what the top 100 priorities are? (that seems to be the next place everyone can argue) and... #2: What if one of our top 5 priorities doesn't need a top 5 amount of money? And conversely what if priority #19 costs 10 times more than priority # 5? </p>
                <span class="author">Christian Mickelsen, <span class="independent">INDEPENDENT</span> from San Diego, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Very interesting concept you have described here Rick. I am curious on how it will progress as it rolls out. I am not really a <span class="republican">REPUBLICAN</span>, but rather a Conservative (that should be a choice as should Liberal). While am probably further to the right than most, I believe that most of the people in the country as a whole leads their lives somewhat to the right of center (regardless of their political affiliation), so if your great concept can get everyone to see common ground both in their lives and in their politics, it will be a great achievement. All the best! Dom</p>
                <span class="author">Dom Cassone, <span class="republican">REPUBLICAN</span> from Northborough, MA</span>
            </div>
            <div class="single-testimonial">
                <p>It's time for each American to realize many of the powers that be want different parties fighting with each other and playing the blame game. The reality is people from each party do have a lot of commonality and would be better served working together. </p>
                <span class="author">Jeff Grounds, <span class="republican">REPUBLICAN</span> from Meridian, ID</span>
            </div>
            <div class="single-testimonial">
                <p>The world as it stands, is in a Lose/Lose position. A revitalization of the values that established America as the greatest, strongest and most diplomatic nation in the world is LONG overdue, and needed, for the USA to retake its role as the land of opportunity. I am Canadian, but where you go, we go and we too are losing many of the similar core values as the USA that made ours a country envied around the world.....We all need truth from our leadership to be able to restablish a world where everyone can gain a true sense of justice and liberty for all! TheSolution may just be the answer that will lead the way ! </p>
                <span class="author">Cheryl Cartwright, <span class="thirdparty">3RD-PARTY</span> from Montreal, QC</span>
            </div>
            <div class="single-testimonial">
                <p>This is the idea that I've been hoping for. If we continue to play the "my side is better than your side" game, we are finished as a country. The Solution gives us a way to work together without compromising ideals.</p>
                <span class="author">Hurst Peacock, <span class="progressive">PROGRESSIVE</span> from Auburn/Alabama</span>
            </div>
            <div class="single-testimonial">
                <p>It is time for people to demand transparency from their elected officials. This may be an effective start. This may be the creative, Internet-generation solutions we all know is somehow possible. This may diminish the power of special interest groups (left and right) that work again most of us. The current Dem/Reb system is broken and this may be a first step towards a fix.</p>
                <span class="author">John J. Woods, <span class="independent">INDEPENDENT</span> from Saint Louis, MO</span>
            </div>
            <div class="single-testimonial">
                <p>We Don't Win Unless We All Win !! This is a metaphor for all of our actions, choices, and relationships. And Love is not gazing in each others eyes, but looking in the same direction. I Love everything about this movement !</p>
                <span class="author">Daniel, <span class="independent">INDEPENDENT</span> from Cardiff-by-the-Sea</span>
            </div>
            <div class="single-testimonial">
                <p>This looks like the answer for everyone to work together to get America moving forward.</p>
                <span class="author">Gene Mason, <span class="independent">INDEPENDENT</span> from Crested Butte, Co</span>
            </div>
            <div class="single-testimonial">
                <p>It is time to end the two party system that is constantly at loggerheads, not accomplishing anything, and just playing politics at our expense. The Solution may be the answer.</p>
                <span class="author">Kathy Ishikawa, <span class="independent">INDEPENDENT</span> from Watsonville, California</span>
            </div>
            <div class="single-testimonial">
                <p>I'm quite hopeful... these past 20 years have simply eroded our country - and caused me to just about throw the towel in on caring about where we're heading. Thanks for your efforts - I'm definitely interested in where this can go.</p>
                <span class="author">Michael Patton, <span class="independent">INDEPENDENT</span> from Las Vegas, NV</span>
            </div>
            <div class="single-testimonial">
                <p>It is clarity of thought. It is balance of heart and mind. It is based on the premise that we are one people, as opposed to being separate. It gives me hope, personally, that we might be able work together and return to balance.</p>
                <span class="author">Tamera Tabor, <span class="libertarian">LIBERTARIAN</span> from Jacksonville Florida</span>
            </div>
            <div class="single-testimonial">
                <p>This is a must. You have my full support!</p>
                <span class="author">Robby, <span class="democrat">DEMOCRAT</span> from Asheville, NC</span>
            </div>
            <div class="single-testimonial">
                <p>Rick, just after you called Bernie Sanders an <span class="independent">INDEPENDENT</span> Senator from Vermont was talking about how the Ryan budget was not going to work and that we need to try to find a better way to balance the budget. I would highly recommend that you contact him and get him on board as I think he might be very interested.</p>
                <span class="author">Mimi Lupin, <span class="democrat">DEMOCRAT</span> from Hot Springs</span>
            </div>
            <div class="single-testimonial">
                <p>Watch for my SOLUTION TO REDUCE THE NATIONAL DEBT SEPARATE EMAIL. YOU CAN USE IT!</p>
                <span class="author">Joe Sabah, <span class="independent">INDEPENDENT</span> from Denver CO</span>
            </div>
            <div class="single-testimonial">
                <p>I think this makes a lot of sense on the surface. I have a lot of practical questions related to the reality of politics, power and how to get from here to there. The here being the stacked deck of the political system (especially after recent Supreme Court decisions) to the balanced economic, political and social system envisioned by Rick and his group. Rick is extremely intelligent, and I have always admired him. I wonder who else (and I will investigate further) is involved in this movement? I will listen to the webcasts and see if those make sense. Good luck Rick, you will need all you can get in addition to your style and acumen.</p>
                <span class="author">Chuck Cory, <span class="independent">INDEPENDENT</span> from Broomfield, CO</span>
            </div>
            <div class="single-testimonial">
                <p>THIS IS THE DIFERENCE : THE POLITICAL VIEWS IS ... THE VIWES OF THIS WORLD...IS THIS WORLD COMMUNITY VIEWS I HAVE NO POLITICAL VIEWS.......MY VEWS ...IS THE VIEWS ..OF THE WORLD ...WHICH JUST ARRIVED .....IN THE FIRS MOUNTH OF THIS YEAR....I WILL WRITE MUCH MORE ABOUT THIS KIND OF VIEWS......WHAT I WAN TO SAY NOW IS THAT THIS VIEWS NOT MADE A DIFERENCE BETWEEN THE PEOPLE OF THIS WORLD ....... THIS IS THE DIFFERENCE ........</p>
                <span class="author">SILVESTRU, <span class="thirdparty">3RD-PARTY</span> from BUCHAREST</span>
            </div>
            <div class="single-testimonial">
                <p>This seems to make sense to me. I'd like to hear more</p>
                <span class="author">Jeff, <span class="independent">INDEPENDENT</span> from San Diego, Ca.</span>
            </div>
            <div class="single-testimonial">
                <p>The concept seems possible and doable.</p>
                <span class="author">David Wynn Smith, <span class="independent">INDEPENDENT</span> from Fresno, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Great work Rick. Brilliant.</p>
                <span class="author">Tom , <span class="independent">INDEPENDENT</span> from Vancouver, Canada</span>
            </div>
            <div class="single-testimonial">
                <p>The Solution creates a balance that I have not seen before. It creates hope that we as a country can be on the same team and not fight over petty things. </p>
                <span class="author">Sara, <span class="democrat">DEMOCRAT</span> from Phoenix, Arizona</span>
            </div>
            <div class="single-testimonial">
                <p>I found this to be very interesting and informative. It would be great if our government would go for it. I'm sending it out to all my friends on Facebook and email. </p>
                <span class="author">Deborah, <span class="libertarian">LIBERTARIAN</span> from Houston/TX</span>
            </div>
            <div class="single-testimonial">
                <p>I'm impressed so far with what I'm hearing. I would like to know more</p>
                <span class="author">Dana, <span class="independent">INDEPENDENT</span> from Spring Valley</span>
            </div>
            <div class="single-testimonial">
                <p>very interested in the possible change</p>
                <span class="author">John, <span class="republican">REPUBLICAN</span> from Orlando</span>
            </div>
            <div class="single-testimonial">
                <p>The Solution is the first approach I've ever seen that provides a true opportunity to unite the voices of [virtually all] the people. It departs from the age-old "us-vs-them" mentality that has served to literally divide our country, and moves us from compromise (win-lose) to collaboration (win-win). As human beings, it is a truth that most of us have the same fundamental desires regarding life, liberty and the pursuit of happiness. Where we have seen great divide is in our ideas and philosophies on how to get there. This has created an environment where the "left" sees those on the "right" as being heartless, while those on the "right" see those on the "left" as idiots. As I currently understand the WWR Philosophy, the only people who could possibly oppose it are the political elitists who want power (and control) for the sake of power (and control). </p>
                <span class="author">Tim, <span class="independent">INDEPENDENT</span> from Swanzey, NH</span>
            </div>
            <div class="single-testimonial">
                <p>The vision behind the concept models presented here is one I can comfortably endorse. The concept models are beautiful in their simplicity and inspired in their balance. If done right, this movement has the potential to allow the people to reclaim the values government has hijacked from us.</p>
                <span class="author">Valary, <span class="independent">INDEPENDENT</span> from Encinitas, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Finally someone is talking about the solution and not the problem.</p>
                <span class="author">Morgan, <span class="republican">REPUBLICAN</span> from Connecticut</span>
            </div>
            <div class="single-testimonial">
                <p>I am looking forward to supporting any movement that brings our country back to the principles it was founded on - a government for the people by the people.</p>
                <span class="author">Ty Bohannon, <span class="independent">INDEPENDENT</span> from Aurora, CO</span>
            </div>
            <div class="single-testimonial">
                <p>Sounds interesting... however I still do not understand how it will work in "real life". Need specific details, such as a sample models. </p>
                <span class="author">Bruno, <span class="republican">REPUBLICAN</span> from Grants Pass, OR</span>
            </div>
            <div class="single-testimonial">
                <p>Thanks We have come full circle Welcome home We are back to pragmatism</p>
                <span class="author">Neil Cosentino, <span class="independent">INDEPENDENT</span> from Tampa Florida</span>
            </div>
            <div class="single-testimonial">
                <p>Just remember, the "Politico" has been in power for more than 111 years. "IF" they wanted a solution, we'd have one. Move them all out, start over and effect the plan.</p>
                <span class="author">Doug, <span class="libertarian">LIBERTARIAN</span> from Centennial, CO</span>
            </div>
            <div class="single-testimonial">
                <p>Finally, taking a psychological/mathematical approach to politics. Using our heads instead of raw emotions. When government no longer serves the people, the people have a duty to change their government. The Solution can succeed only if everyone agrees. It's time for the people to stand together so special interest will not be able to dictate policy any more. </p>
                <span class="author">Cory, <span class="independent">INDEPENDENT</span> from San Diego, California</span>
            </div>
            <div class="single-testimonial">
                <p>Time for us to come together, instead of continuing to argue about who is "right". Bottom line, we do share core beliefs and have core needs and this is a perfect way for us to end the separation. Capping spending and having priorities is how a person would budget their own money effectively and so I see no reason why it wouldn't work in government also. Thank You for all you are doing to help all of us!</p>
                <span class="author">Nancy, <span class="independent">INDEPENDENT</span> from Carmen, Idaho</span>
            </div>
            <div class="single-testimonial">
                <p>Hi Thanks for your mail now. Raza Khan</p>
                <span class="author">Raza, <span class="independent">INDEPENDENT</span> from Gulshan-e-TownSindh</span>
            </div>
            <div class="single-testimonial">
                <p>I LOVE the idea that Rick has shown. This is the same idea I have thought about for years but finally someone has put it all together.</p>
                <span class="author">Joshua, <span class="republican">REPUBLICAN</span> from Escondido, CA</span>
            </div>
            <div class="single-testimonial">
                <p>A method of guiding spending that all sides could be happy with? i'd like to hear more about how that would work. Politics usually brings out the worst in people, and I'd love to be able to able to get behind a solution that is practical and effective.</p>
                <span class="author">Mary, <span class="independent">INDEPENDENT</span> from Birmingham, AL</span>
            </div>
            <div class="single-testimonial">
                <p>Wow. An idea who's time has come. I'm fascinated at how you put together that bell curve and tied everything together so powerfully. It is a concept that, if we can get enough people to understand and embrace, can truly save this Country!</p>
                <span class="author">Christina, <span class="democrat">DEMOCRAT</span> from Sarasota, FL</span>
            </div>
            <div class="single-testimonial">
                <p>As a registered independent, I like the Solution because it raises political discourse up from current destructive radical polarization to constructive intelligent debate. </p>
                <span class="author">Aila , <span class="independent">INDEPENDENT</span> from Charleston</span>
            </div>
            <div class="single-testimonial">
                <p>The center used to be a muddy place until the idea of this Solution. The center should pull the left and right wings with it, like the head on your shoulders and the heart in your chest pulls your arms and legs to move in a certain direction... there is no need for left and right arms to flay at each other. now we have a head and a heart that control them both.</p>
                <span class="author">Eugene, <span class="republican">REPUBLICAN</span> from Anchorage, Alaska</span>
            </div>
            <div class="single-testimonial">
                <p>This proposal is very creative! I especially like the fact that you are trying to make the world a better place since that is the name of my foundation to help divorcing parents protect their children from the negative effects of divorce. I think Rick's idea could be the answer to the problems the politicans are having in deciding how to ward off the majority financial diaster that our country could be headed towards. My question is, how are you going to make this Solution get to critical mass so that a large percentage of the U.S. insist that our government use this idea to make the world a better place?</p>
                <span class="author">Mimi Lupin, <span class="democrat">DEMOCRAT</span> from Hot Springs, Ar.</span>
            </div>
            <div class="single-testimonial">
                <p>It's just makes sense! </p>
                <span class="author">Russell, <span class="republican">REPUBLICAN</span> from Yorktown, VA</span>
            </div>
            <div class="single-testimonial">
                <p>Sounds too idealistic, but it might be an ideal that a larger than necessary majority can agree to pursue.</p>
                <span class="author">Robert, <span class="independent">INDEPENDENT</span> from Edison, NJ</span>
            </div>
            <div class="single-testimonial">
                <p>I like the Solution because it promotes fiscal responsibility and transparency in government. The Solution is a positive and collaborative approach to solving the problems our country faces today.</p>
                <span class="author">Mike, <span class="independent">INDEPENDENT</span> from Austin, Texas</span>
            </div>
            <div class="single-testimonial">
                <p>Take this all the way Rick! We need you to lead us in the right direction..... we will follow!</p>
                <span class="author">Randall Robbins, <span class="democrat">DEMOCRAT</span> from Charlotte, NC</span>
            </div>
            <div class="single-testimonial">
                <p>Rick Raddatz once again demonstrates his is brilliance! If you love America, Capitalism, Our Constitution and have a compassionate heart to see that no person on this planet is without food, shelter and a education you must watch this video… It's who I AM! Our Founding Fathers wanted co-operation in the highest sense of the word.. They truly believed that Man's freedom comes from GOD and the we have an opportunity to express and share that freedom with everyone. We have to love one another in spite of our differences in polical, religious, and Humaniterian views. </p>
                <span class="author">Jerry, <span class="libertarian">LIBERTARIAN</span> from Vista, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Looks good. Looking forward to seeing the technology to assist and make the system work in practice. </p>
                <span class="author">Anthony Lawton, <span class="independent">INDEPENDENT</span> from UK</span>
            </div>
            <div class="single-testimonial">
                <p>It's time to find a way to listen to each other and celebrate our patriotism, no matter what our political views are (or have been). I am a proud American first and foremost. The Solution supports that!</p>
                <span class="author">Deborah, <span class="progressive">PROGRESSIVE</span> from Phoenix, AZ</span>
            </div>
            <div class="single-testimonial">
                <p>Looks like a very well thought out and developed organisation. Charityism is a mouthful and a bit hard on the senses - how about compassionism - giving the already coined phrase that works compassionate capitalism.</p>
                <span class="author">Geoff, <span class="thirdparty">3RD-PARTY</span> from USA</span>
            </div>
            <div class="single-testimonial">
                <p>Effectiveness, compromising, transparency, helping people in need and responsible government.</p>
                <span class="author">Kaare, <span class="republican">REPUBLICAN</span> from Effingham, IL</span>
            </div>
            <div class="single-testimonial">
                <p>It brings the heart, soul and head together of humanity, addressing the needs, wants, and desires of all people under one collaborative system. </p>
                <span class="author">Marilyn, <span class="independent">INDEPENDENT</span> from Los Angeles</span>
            </div>
            <div class="single-testimonial">
                <p>Simply amazing....the best synergistic make sense approach to run the country encompassing all views,working together to the common goal</p>
                <span class="author">Geoff Guirk , <span class="libertarian">LIBERTARIAN</span> from East Hanover NJ</span>
            </div>
            <div class="single-testimonial">
                <p>Two things come to mind.... You need a national communications platform that brings focus from eMails, Twitter, et al and you need a public presentable bully-pulpit. I believe you will find both at www.AmericansRestoringAmerica.com. Good job, Rick. Michael Edward Ps. I have two accounts with you. </p>
                <span class="author">Michael Edward, <span class="thirdparty">3RD-PARTY</span> from Central Florida</span>
            </div>
            <div class="single-testimonial">
                <p>I believe it's true that all political viewpoints have more in common than opposed - it's HOW we talk about what we want that creates such HUGE ILLUSIONS of separate interests. Thank you, Rick, for being willing to lead in this area despite the landmines, and for being willing to put effort into using language we can all hear instead of resist. I've often dreamed of BOB - best of both parties - but there are more than two, and I believe more than every before, we are ready to meet in the middle and transcend differences for the common good.</p>
                <span class="author">Susan, <span class="independent">INDEPENDENT</span> from Atlanta GA</span>
            </div>
            <div class="single-testimonial">
                <p>I am not sure that I am supportive but I would rather read the manifesto and apparently I have to jump through this hoop to get it.</p>
                <span class="author">Cathe, <span class="democrat">DEMOCRAT</span> from St. Louis, MO</span>
            </div>
            <div class="single-testimonial">
                <p>No matter your party or political, philosophical leaning, we're all looking for better answers to what are government has presented. Our country is ailing - it's undeniable. Mainly, because we are overly married to views that are unable to answer the most important priorities. Tri-ism, at the very least, is worth a serious look for every single, engaged citizen from, the far left, the far right and everything in between. At best, it offers a gallant first step towards something better, viable and appealing to many us wanting a more responsive government</p>
                <span class="author">Bruce, <span class="independent">INDEPENDENT</span> from Fort Collins, CO</span>
            </div>
            <div class="single-testimonial">
                <p>Amazing work, Rick. You were born for this! I will be sending around to hundreds of folks - I do hope this makes a difference</p>
                <span class="author">Henri, <span class="independent">INDEPENDENT</span> from Washington, DC</span>
            </div>
            <div class="single-testimonial">
                <p>I love this idea because finally everyone in America can work together to help our country become what it can become...its an inspiring message this country has not seen in a long time. Rick, I don't know where this idea came from, but thank you for putting such a compelling message together. Is this movement a not for profit related to fund raising</p>
                <span class="author">Frank, <span class="independent">INDEPENDENT</span> from Huntington, NY</span>
            </div>
            <div class="single-testimonial">
                <p>I am wary of the partisanship that is tearing this country apart at its seams. I need an oasis of just being able to talk to my fellow Americans of all opinions about how we can take our country forward without leaving people behind. I am over the stereotypes and passionate raw emotions that can no longer even engage with the other side. I am here for HOPE and SANITY and not hypersensitivity, propaganda, or unreasoned/untested opinions. Thank you, Rick, and God Bless you. </p>
                <span class="author">Faith, <span class="republican">REPUBLICAN</span> from Cleveland, Ohio</span>
            </div>
            <div class="single-testimonial">
                <p>The message alone is well thought out. It does a great job of explaining why we are struggling and fighting ourselves when deep down each of us just wants fairness in our society. Also, we're sick of the divide and we're sick of representatives, corrupted by special interest, setting our priorities. It seems like a longshot that this could be realized. It doesn't seem like anyone is asking very much. Just tell everyone you know.</p>
                <span class="author">Patrick Madden, <span class="progressive">PROGRESSIVE</span> from White Lake, MI</span>
            </div>
            <div class="single-testimonial">
                <p>The potential for this proposal to develop into an efficient, effective and bias-averse framework of government is truly remarkable.</p>
                <span class="author">Craig, <span class="progressive">PROGRESSIVE</span> from Texas</span>
            </div>
            <div class="single-testimonial">
                <p>It is typically Islamic manner that rich people have to support poor people in the society by paying (Zakaa) is a must and it is a percent of your saving and (sadaka) is the volunteer part as you feel people need and it is other than taxes </p>
                <span class="author">Ashraf Awny, <span class="democrat">DEMOCRAT</span> from cairo egypt</span>
            </div>
            <div class="single-testimonial">
                <p>I listened to the presentation and even though it sounds plausible and even desirable, it would require a major clearing of the infestation we call Congress. Neither side will roll over willingly and more that likely fight it tooth and nail. Common sense has been lost in the deluded ideals that many now claim to desire. Sad, but true. Good Luck with your endeavor.</p>
                <span class="author">Ken Gibbs, <span class="independent">INDEPENDENT</span> from Fresno, California</span>
            </div>
            <div class="single-testimonial">
                <p>I've been thinking and praying for a solution to the political mess we find ourselves in currently. THIS IS THE ANSWER!!</p>
                <span class="author">Patricia Weibel, <span class="republican">REPUBLICAN</span> from Shawnee Mission, KS</span>
            </div>
            <div class="single-testimonial">
                <p>Great insight.</p>
                <span class="author">Catherine Hays, <span class="libertarian">LIBERTARIAN</span> from Murrsysville,PA</span>
            </div>
            <div class="single-testimonial">
                <p>Everybody NEEDS a little T.L.C.:)</p>
                <span class="author">Traci, <span class="independent">INDEPENDENT</span> from Ohio</span>
            </div>
            <div class="single-testimonial">
                <p>It's closer to the "American" gov't I've been spouting about. Get rid of the REPUBLICAN, Democrat, whatever label, and represent the People.</p>
                <span class="author">Walter Comer, <span class="independent">INDEPENDENT</span> from Waynesville</span>
            </div>
            <div class="single-testimonial">
                <p>I'm guessing more people would like to do this but have become complacent and believe that their vote just doesn't matter like it use to. It takes a lot of people to make this work. It's a good thing if for no other reason than so ''we the people'' can take control back of our country's direction....before its too late.</p>
                <span class="author">Dr. Patrick Havey, <span class="republican">REPUBLICAN</span> from St Louis MO</span>
            </div>
            <div class="single-testimonial">
                <p>I support the concept of Solution because it is a way to bring out the best in all political philosophies, but most of all I love transparency. We have lived too long with government that cloaks almost everything it does and provides a dark hole in which to bury the greed and avirice of most politians.</p>
                <span class="author">Maurice Evans, <span class="independent">INDEPENDENT</span> from Payson, UT</span>
            </div>
            <div class="single-testimonial">
                <p>It's a Revolution of Hope for Change. Something that stops the hammering of political interest groups to control government and government to create more sanctions against the true investors us!</p>
                <span class="author">Jalica Miller, <span class="democrat">DEMOCRAT</span> from Gufport, MS</span>
            </div>
            <div class="single-testimonial">
                <p>Every one is involved</p>
                <span class="author">Dominador C. Awiten, <span class="thirdparty">3RD-PARTY</span> from New York </span>
            </div>
            <div class="single-testimonial">
                <p>Finally a government that would actually be for the people instead of the polititions! I am so tired of the fighting and the childishness of those in Washington with their "If you don't give me what I want, you can't have what you want" attitude. </p>
                <span class="author">Chris Hartman, <span class="republican">REPUBLICAN</span> from Toledo, Ohio</span>
            </div>
            <div class="single-testimonial">
                <p>The Solution message reflects America as it was created, as it should be now and what we need for our republic to bring it back as the greatest nation in the world. It reflects charity with hard work. In God we Trust! </p>
                <span class="author">Terrt Ruth, <span class="republican">REPUBLICAN</span> from Hooks/Texas</span>
            </div>
            <div class="single-testimonial">
                <p>It's about time that a system has something for everyone! I'm a registered Demograt, however, I consider myself and Independent Conservative. Lets cut wasteful and foolish spending! Let's spend Wisely! I like the Solution because it brings everyone to the middle. Yes, it's not perfect, but it sounds better than what we have now. And I really think that it will work! </p>
                <span class="author">Juan M. Varela, <span class="independent">INDEPENDENT</span> from San Antonio, TX </span>
            </div>
            <div class="single-testimonial">
                <p>I like this Solution because it's fair and it makes sense. we need to be wise with our life and our resources and this seems to be the solution. </p>
                <span class="author">Cleofe Quibote, <span class="republican">REPUBLICAN</span> from Berkeley, CA</span>
            </div>
            <div class="single-testimonial">
                <p>If this has or gets some muscle / marketing behind it, I think this concept if implemented soon enough will change / save our country back to a positive influence for the world!</p>
                <span class="author">David Wilson, <span class="republican">REPUBLICAN</span> from Danville</span>
            </div>
            <div class="single-testimonial">
                <p>Brilliant finally the people can work together for the greatest good of all.</p>
                <span class="author">Wanda Van-Der-Zyden, <span class="independent">INDEPENDENT</span> from UK</span>
            </div>
            <div class="single-testimonial">
                <p>I think this concept has great potential to gather us all on a winning team for the betterment of our world. It may need some fine tuning in the future; however, if our expenditures have to be prioritized, we should be able to weed out the waste and ridiculous spending that goes on today. We have gotten to the point today where all our representatives know how to do is spend, spend, spend and for things that serve no purpose, are wasteful or do not serve for the betterment of the people or world we live in. Our government today is absolutely dysfunctional and does not work together on anything. It is a complete knock down, drag out on everything. It functions like a couple of spoiled siblings fighting over a piece of candy and running back and forth to the parents to settle the argument. Consequently, noting gets done and if it does, it takes for ever and in the end the finished product is a disaster and disliked by all. I believe, the Solution would keep our representative's thoughts on the true objective by requiring some thought of honesty as to priorities, having to justify expenditures and on a capped budget. I used to conduct sales meetings and the meetings would become grip sessions and we would all leave the meetings with nothing solved. I then got the idea and informed the salesmen prior to the next meeting that they could bring up any problem they were having; HOWEVER, they would be required to suggest at least one solution to that problem; otherwise, they could not voice their problem. Oddly enough, meetings became very productive, problems were usually solved during that meeting because everyone would join in with their suggestions and the problems were solved immediately and all left the meeting feeling better about themselves for contributing to the solution. We became a successful team and all worked together. </p>
                <span class="author">Bud Clark, <span class="republican">REPUBLICAN</span> from Broken Arrow, OK</span>
            </div>
            <div class="single-testimonial">
                <p>This is a very good program.And hopefully as much as possible people have a heart to participate this, and are willing to change for our future and for our kids future.Its very important to help each other and doing together.</p>
                <span class="author">Teresa, <span class="republican">REPUBLICAN</span> from Sweden</span>
            </div>
            <div class="single-testimonial">
                <p>Exploitation of people is existing throughout the world .Hence the entire people of the world should unite to fight for the well being of ALL and the EARTH a happy place to live-Venu,TIKKOTI,Kerala INDIA</p>
                <span class="author">Venu, <span class="democrat">DEMOCRAT</span> from Kozhikode,India</span>
            </div>
            <div class="single-testimonial">
                <p>I LIKE THIS IDEA , I BELIEVE IN HELPING OTHERS BY DOING FOR THEM WHAT CAN ENABLE THEM TO HELP THEMSELVES . THE SYSTEM WE HAVE IN PLACE NOW PITS FOR POLITICAL GAIN THE HELPERS AND RECEIVERS AGAINST EACH OTHER . I THINK THIS IDEA PROMOTES A RESPONSIBLE WAY TO MAKE THE GOVERNMENT STOP PITTING US AGAINST EACH OTHER -- NOT WASTE OUR MONEYS AND EFFORTS AND TO MAKE TRANSPARENT THE PROGRAMS BY THEIR PRIORITY'S AND GRADING -- GREAT IDEAS I SUPPORT </p>
                <span class="author">WALLY MARIENAU, <span class="independent">INDEPENDENT</span> from punta gorda FL</span>
            </div>
            <div class="single-testimonial">
                <p>This is the best way to solved conflict. Everybody knows that when we argue we separate as friends not enemies for the essence of democracy is to ventilate issues and both sides will understand that a sound discussions will benefit both sides and arrived to a best solutions driven by a win - win atmosphere/solutions.</p>
                <span class="author">Dr. Wilfredo P. Resoso, <span class="progressive">PROGRESSIVE</span> from Philippines</span>
            </div>
            <div class="single-testimonial">
                <p>Looking for ACTION. Gridlock is painful</p>
                <span class="author">Christina Daly, <span class="democrat">DEMOCRAT</span> from California</span>
            </div>
            <div class="single-testimonial">
                <p>Brilliant! You have really picked up on the enormous need of the right and left learning to work together again towards making our country great and what the founder intended (for the most part) </p>
                <span class="author">John Hill, <span class="republican">REPUBLICAN</span> from Lebanon, TN</span>
            </div>
            <div class="single-testimonial">
                <p>Sounds great, but an uphill battle since transparency, would eliminate greed and corruption. both parties are so embedded in both, they will fight this tooth and nail. spread the word, because there are powers in numbers. </p>
                <span class="author">Rick Foster, <span class="independent">INDEPENDENT</span> from Mooresville</span>
            </div>
            <div class="single-testimonial">
                <p>Hi Rick, Congratulations for the brilliant and timely concept and campaign. I support you and hope it won't get "circumcised" as so many things and people in the USA. Good luck and warm regards, As. Prof. PhD. Petar Mitov Sofia, BulgARIA</p>
                <span class="author">Petar, <span class="independent">INDEPENDENT</span> from Sofia</span>
            </div>
            <div class="single-testimonial">
                <p>Great ideas, basic life points</p>
                <span class="author">Tom Wright, <span class="republican">REPUBLICAN</span> from Wildwood, Missouri</span>
            </div>
            <div class="single-testimonial">
                <p>I'd like to respond to Dan Hendleman's (the independent from California who wrote the lengthy "disagree" message) comments. Dan seems to be a man who likes pointing out the problems in a situation, which is easy to do regardless of one's political leanings....we have problems everywhere. The cornerstone of any good debate is to present an alternative solution to solving the problem. Anyone can "whine." (I even do it myself on occasion!) I'm sorry for Dan, he seems to be stuck in a whining mode...of course many people are and they seems to spend their days looking for someone to blame. Rick, you've got a good idea here, even if it's merely a republican idea with a new coat of paint which Dan seems to be suggesting. I think what you're trying to convey to people is the thought that, "hey, it's not just Democrats and it's just not republicans...it's the System. The System is the problem and if we, as Americans...the People, want to change the System we need to first present a new Solution to change the System, and then through the power of our Constitution and the mechanism of the popular vote Change our System. Rick has noted that the current System - the politicians in power - will not easily or likely accept this change. So he is challenging us to put the power of change into our own hands. Dan and others may not wish to do so, or they may simply wish to say why it won't work. Dan, when you have a better plan - or even a plan at all - I am willing to listen to it. The one thing I do know is that America is in trouble. Financially in trouble. Leadership (whether republican or Democrat) in trouble. Education in trouble, and Infrastructure in trouble. Much has been written about America's resemblance to Rome in her final years. I'd prefer not to have our country crumble by the time my children or children's children become adults. Yes, WE have a problem. The problem will not solve itself and will not be solved by the current structure of government (sadly to say). We need a new solution. Rick's Solution might be the catalyst we need to find and implement that solution. Thanks Rick for your endeavor!</p>
                <span class="author">Steve Leedom, <span class="republican">REPUBLICAN</span> from El Dorado Hills, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Rick, what I like the most about WWR is that it appeals to all sides of the political spectrum. What we need for the country to survive is TRANSPARENCY. I'm an internet marketer too, with my own business as a consultant (Search Commander, Inc.) and with some white label tools - (SEOautomatic.com) I'm also an affiliate marketer, I make a good living, and can make my own time to spend as I see fit - That said, I would LOVE to devote some time to helping you, and helping promote WWR - Please get in touch... Scott Hendison 503.522.9244</p>
                <span class="author">Scott Hendison, <span class="independent">INDEPENDENT</span> from Portland, OR</span>
            </div>
            <div class="single-testimonial">
                <p>Watching closely from the UK!</p>
                <span class="author">Stephen Pett, <span class="independent">INDEPENDENT</span> from East Sussex</span>
            </div>
            <div class="single-testimonial">
                <p>Nice</p>
                <span class="author">Abhishek, <span class="independent">INDEPENDENT</span> from Ranchi</span>
            </div>
            <div class="single-testimonial">
                <p>This has been my belief my whole life.. I'm in</p>
                <span class="author">David Mason, <span class="democrat">DEMOCRAT</span> from San Diego</span>
            </div>
            <div class="single-testimonial">
                <p>I think that every American knows that our government is wasteful, but Democrats don't want to sacrifice government spending for fear of losing our ability to help people and <span class="republican">REPUBLICAN</span>s don't want spend as much because it negatively affects their personal finances and never ends up as the money was originally intended. I totally believe that the Solution’s ideas could work, but fear that they would also become corrupted in the hands of our leaders. If the grading system works, this idea is absolutely brilliant.</p>
                <span class="author">Dustin, <span class="democrat">DEMOCRAT</span> from Aberdeen, SD</span>
            </div>
            <div class="single-testimonial">
                <p>Balance and consideration of all people! The political bickering isn't working. Also, I like the fact that American citizens can be involved and take part in change this country really needs because Washington "ain't getting it done"!</p>
                <span class="author">Theresa, <span class="progressive">PROGRESSIVE</span> from Dallas, Texas</span>
            </div>
            <div class="single-testimonial">
                <p>It promotes working together. Our current system promotes defeating the others even more than actual success. This is aptly named, we CAN find a way for us all to win.</p>
                <span class="author">Adrienne, <span class="progressive">PROGRESSIVE</span> from yorktown hts, ny</span>
            </div>
            <div class="single-testimonial">
                <p>Great idea - the time is right for this</p>
                <span class="author">Marius, <span class="independent">INDEPENDENT</span> from Munich/Bavaria/Germany</span>
            </div>
            <div class="single-testimonial">
                <p>USA visa!</p>
                <span class="author">Nyamerdene, <span class="republican">REPUBLICAN</span> from Ulaanbaatar</span>
            </div>
            <div class="single-testimonial">
                <p>Very interesting and doable with enough involvement and hard work from those of us who are sick and tired of the direction our country is going. Thanks for this Rick, well done.</p>
                <span class="author">Randy, <span class="republican">REPUBLICAN</span> from Las Vegas NV</span>
            </div>
            <div class="single-testimonial">
                <p>Love the idea of putting a spirit, mind, and body to politics. This is the kind of simple system that will take us to the next level of human developement socially. This is what our founding father would have wanted us to think of for the future. Weed out all the negatives and use all the positives of social interaction using the system that is already in place. I support it 1000%</p>
                <span class="author">Thomas, <span class="independent">INDEPENDENT</span> from Las Vegas, NV. </span>
            </div>
            <div class="single-testimonial">
                <p>Your ideas are brilliant. No doubt about it. In theory it could well be the salvation of our species and our planet. BUT, I have a practical problem with your approach: The present system strongly favors greed and lies and fraud when it comes to being elected to government. How do we re-design the system to get honest, altruistic, competent, intelligent and wise people with common sense to run the government for us, regardless of its size? - I don´t see many such people around today, and the few I do see are usually marginalized or destroyed by corrupt greedy players who command more money and influence. OK, I know that transparency is key, and the emerging Aquarian Paradigm IS bringing more transparency to the scene, but how do we ensure it, along with honesty and integrity in our rulers? - www.ParadigmWatch.com </p>
                <span class="author">Jens Jerndal, <span class="independent">INDEPENDENT</span> from Supranational</span>
            </div>
            <div class="single-testimonial">
                <p>I think the concept of a The Solution has merit. I want to learn more. So far it seems our system is just not working and we need to do something. I am wondering how the powers to be and the lobbyists are going to take this! </p>
                <span class="author">Stella, <span class="thirdparty">3RD-PARTY</span> from Glenview, IL</span>
            </div>
            <div class="single-testimonial">
                <p>Brilliant & Well Done!</p>
                <span class="author">Greg, <span class="republican">REPUBLICAN</span> from Escondido, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Wow, the Solution truly brings the heart and head of government spending together in a balanced collaboration. This seems ideal for the family budget too. Bottom line - A. cap spending to stay in your budget B. Agreed prioritized spending within that budget.</p>
                <span class="author">Barbara, <span class="independent">INDEPENDENT</span> from Mundelein, IL</span>
            </div>
            <div class="single-testimonial">
                <p>Finally Government that makes sense. There are more people that think like this that those that are selfish and greedy. Now we need to address the tax issue and go to a sales income tax. That way everybody pays even illegals, criminals and those who use tax loop holes. Then it would be a small amount from all instead of a lot from a few.</p>
                <span class="author">Michael Hitchens, <span class="progressive">PROGRESSIVE</span> from Indianapolis In</span>
            </div>
            <div class="single-testimonial">
                <p>Interesting ideas here.</p>
                <span class="author">Verlyn Kroon, <span class="republican">REPUBLICAN</span> from Omaha, NE</span>
            </div>
            <div class="single-testimonial">
                <p>Finally here is something to really get excited about! Instead of the constant bickering back and forth of the political parties and the media support of one or the other, here is a solution where everyone works together to effect a win/win for every political view. Capitalism and charity-ism come together to benefit self sufficient and needy alike. Everyone can be happy with the result. </p>
                <span class="author">Phil, <span class="libertarian">LIBERTARIAN</span> from Grand Junction, CO</span>
            </div>
            <div class="single-testimonial">
                <p>I support this! My company has the same type of winning agenda..! </p>
                <span class="author">John, <span class="democrat">DEMOCRAT</span> from Lafayette, La</span>
            </div>
            <div class="single-testimonial">
                <p>Awesome Idea will promote this immediately.</p>
                <span class="author">Peter Walton, <span class="republican">REPUBLICAN</span> from USA</span>
            </div>
            <div class="single-testimonial">
                <p>I'd like to get Congress to actually prioritize spending. This should eliminate all the pork-barrel politics and add-on's</p>
                <span class="author">Barbara, <span class="independent">INDEPENDENT</span> from NJ</span>
            </div>
            <div class="single-testimonial">
                <p>I'M WITH YOU!</p>
                <span class="author">KATHLEEN , <span class="democrat">DEMOCRAT</span> from PATTERSON/CA</span>
            </div>
            <div class="single-testimonial">
                <p>If the true intentions of the political interests are accurately represented this solution makes sense.</p>
                <span class="author">Tim, <span class="libertarian">LIBERTARIAN</span> from Provo/Utah</span>
            </div>
            <div class="single-testimonial">
                <p>I'll look at your program.</p>
                <span class="author">Mark Jarvis, <span class="libertarian">LIBERTARIAN</span> from Culpeper, VA</span>
            </div>
            <div class="single-testimonial">
                <p>The models reminds me of something I would get from a top tier consulting company. Models are easy to present; it's much harder to get people in leadership to adopt something sensible. Cognitive dissonance; cognitive biases, prejudices, ideology and money always seem to get in the way. I would indeed opt for something better. All systems must evolve and do evolve. Innovation is something hard to legislate. I appreciate your attempt at a 2.0 grass roots attempt to get people involved. I look forward to see if this catches on. 99.9 percent of everything on the internet is worthless unless you know what you are looking for and then 99.0 percent of what we might find may hold great value. Education is the prime value we should not ignore. The mind is our greatest resource. </p>
                <span class="author">Steven , <span class="independent">INDEPENDENT</span> from San Francisco</span>
            </div>
            <div class="single-testimonial">
                <p>It's a great approach in today's political climate.</p>
                <span class="author">Jack, <span class="republican">REPUBLICAN</span> from USA</span>
            </div>
            <div class="single-testimonial">
                <p>This reminds me of the attitude after a tragedy that transcends all social barriers for the common welfare of the affected people. I like this solution these are the common principles this nation was founded with! </p>
                <span class="author">Richard, <span class="republican">REPUBLICAN</span> from Odessa ,TX</span>
            </div>
            <div class="single-testimonial">
                <p>It is the common sense approach I have thought about for years. Everyone takes a little bit from each "plan", the top 10, if you will and formulate what's best for America. This process, Solution, is that with "additives". If our federal leaders really do care about America, they will listen and if Americans really care they will make them listen.</p>
                <span class="author">Steve Thomas, <span class="democrat">DEMOCRAT</span> from Roscoe, IL</span>
            </div>
            <div class="single-testimonial">
                <p>It is the coomn sense approach I have thought about for years. Everyone takes a little bit from each "plan", the top 10, if you will and formulate what's best for America. This process is that with "additives". If our federal leaders really do care about America, they will listen and if Americans really care they make them listen.</p>
                <span class="author">Steve Thomas, <span class="democrat">DEMOCRAT</span> from Roscoe, IL</span>
            </div>
            <div class="single-testimonial">
                <p>The two year olds playing in the National sandbox need to start behaving and find some enforced balance to stabilize the social contract we call our Economy. A starting point is a restatement of the Human rights we value and why . The more words and actions align then the more trust we build into a renewed working contract.</p>
                <span class="author">Keith, <span class="independent">INDEPENDENT</span> from Springfield Va. </span>
            </div>
            <div class="single-testimonial">
                <p>Unity for the good of all.</p>
                <span class="author">Teresa Young, <span class="democrat">DEMOCRAT</span> from Tulsa, OK</span>
            </div>
            <div class="single-testimonial">
                <p>This does not take into account that pretty much all Democratic leaders are power-hungry politicians who have no interest in win-win solutions. The people who vote for Democrats are too ignorant to understand their leaders.</p>
                <span class="author">Minesh Baxi, <span class="republican">REPUBLICAN</span> from Troy</span>
            </div>
            <div class="single-testimonial">
                <p>Transparency, minimization of influence of special interests and a narrowing of the gap that separates the left and right are the strengths I see in this plan</p>
                <span class="author">Paul, <span class="republican">REPUBLICAN</span> from Magnolia, TX</span>
            </div>
            <div class="single-testimonial">
                <p>Limited Government and social justice</p>
                <span class="author">Gene, <span class="independent">INDEPENDENT</span> from Crested Butte, Co</span>
            </div>
            <div class="single-testimonial">
                <p>Changing from a system of greed and a totally different management approach has promise. </p>
                <span class="author">Paul, <span class="independent">INDEPENDENT</span> from USA</span>
            </div>
            <div class="single-testimonial">
                <p>This looks like a unity plan that has great potential to protect our country and world from the chaos that we seem to be spiraling toward... while providing a framework for a bright future for all of us.</p>
                <span class="author">Robby, <span class="independent">INDEPENDENT</span> from Arvada Colorado</span>
            </div>
            <div class="single-testimonial">
                <p>There actually is a simple solution to a solid political view. Heart, mind, and commerce rolled into one small government plan. Very inspiring! Now we need a plan for campaign financing and term limits to truly turn our government back into 'by and for the people'! Politics should not be a career....</p>
                <span class="author">Keith, <span class="progressive">PROGRESSIVE</span> from Naperville, IL </span>
            </div>
            <div class="single-testimonial">
                <p>I see three important points for the Solution to succeed: 1. Truth must be the base point for the transparency of this movement. 2. Coop-etition: Combining Cooperation and Competition can create a healthy society and that’s what I see as the two sides of Win and Win. 3. Balance will be obtained once we all Win-Win at competing for cooperation within ourselves, and with each other, in this Solution.</p>
                <span class="author">Joe, <span class="independent">INDEPENDENT</span> from Cheyenne, Wyoming</span>
            </div>
            <div class="single-testimonial">
                <p>Finally a political position that can work for all and can make us all work for all—All for one, one for all—The Solution.</p>
                <span class="author">Patrick, <span class="independent">INDEPENDENT</span> from Port Chester, NY</span>
            </div>
            <div class="single-testimonial">
                <p>LETS GET IT ALL ON THE TABLE, TO MAKE LIFE MORE STABLE, YOU"RE AN AMERICAN, COME ON YOUR'E ABLE ! Isn't it really a $14 trillion budget of which $8 trillion is "off the table" , let get everything on the table. Simple efficiency improvement & waste reduction could chop 25 % of this $14 Trillion.... use the savings for proplr priority items. No politicians agendas, KISS, "keep it simple"..... lets make a difference ..People Power ! </p>
                <span class="author">Kevin Lane, <span class="progressive">PROGRESSIVE</span> from Carlsbad / California</span>
            </div>
            <div class="single-testimonial">
                <p>We are living in the midst of a giant leap forward for humanity. The Solution appears to be on target and on time to be a vehicle for the evolution to take place</p>
                <span class="author">Jennifer, <span class="independent">INDEPENDENT</span> from Lod, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Finally ... Some realization that it takes capitalism to fund charity. Rich people help fund the wheels for the needy. All I have ever wanted was "good" use of my tax dollars. If they are being used fairly and responsibly, then I have no problem paying them.</p>
                <span class="author">Cory, <span class="republican">REPUBLICAN</span> from Aberdeen, SD</span>
            </div>
            <div class="single-testimonial">
                <p>This is very impressive. Finally, I feel like I see hope for a single plan that we can all believe in. WELL DONE and you have my FULL SUPPORT. Thank you.</p>
                <span class="author">Johnpaul Moses, <span class="independent">INDEPENDENT</span> from Memphis, TN</span>
            </div>
            <div class="single-testimonial">
                <p>The Solution is an inspiring political platform that shows great promise. For the longest time, We the People have needed a way to come together, for the common good of ALL, within a framework where all political views are honored and respected. Until now... that seemed impossible! I'm extremely excited about the potential for Real Change afforded by what the Solution brings to ALL of America's citizens. It's a sea change whose time has come!</p>
                <span class="author">Janice, <span class="democrat">DEMOCRAT</span> from Sparks, NV</span>
            </div>
            <div class="single-testimonial">
                <p>I like stopping the spending and accountability. Also that we quit ruining peoples lives by doing it for them. Lets spend time teaching them.</p>
                <span class="author">Sandy, <span class="thirdparty">3RD-PARTY</span> from Florida</span>
            </div>
            <div class="single-testimonial">
                <p>Cap and Prioritize is a brilliant way to express the need to spend efficiently on only those things that matter most to our country! The model is a terrific framework to begin a different conversation about how our country can unite and prioritize what matters most to our freedom and sovereignty.</p>
                <span class="author">John , <span class="independent">INDEPENDENT</span> from Philadelphia PA</span>
            </div>
            <div class="single-testimonial">
                <p>I hope this gets traction. What we are doing now is not working and we have serious problems that need solving. </p>
                <span class="author">Mike, <span class="independent">INDEPENDENT</span> from Seattle</span>
            </div>

            <div class="single-testimonial">
                <p>This is the first time in my lifetime where I can see that all ideologies of the political spectrum have a chance of working together for the good of all people. I wholeheartedly support the "Solution."</p>
                <span class="author">Sandi, <span class="independent">INDEPENDENT</span> from Puyallup, Wa</span>
            </div>
            <div class="single-testimonial">
                <p>This seems like a great idea. Don't know how well it will spread, but I will do my part.</p>
                <span class="author">Roberto Balcker, <span class="libertarian">LIBERTARIAN</span> from Miami Beach/FL</span>
            </div>
            <div class="single-testimonial">
                <p>It's a system of equality, that will motive all the political forces to work toward one simple and honorable goal to save our country!!</p>
                <span class="author">Julio Gonzalez, <span class="republican">REPUBLICAN</span> from Orlando, Fl. </span>
            </div>
            <div class="single-testimonial">
                <p>The Solution is a wonderful idea/concept that needs to be streamlined in our thinking to be able to counter the old fashioned "Primitive" Win--loose" perspective, which has played in the hands of selfish, greedy, irresponsible Opinion Leaders.. Win--Lose works well in sports, as it brings the best out of competitors, communal collaboration and sometimes taking loosing as good as wining but valuing participation above all. For the solution to function there is a need to bring back people in the mood of taking part, participating and taking part as opposed taking a negative view about policy formulation, influence and discussion. Lots of people have been disenfranchised with the win --lose phenomena and decided to keep away. Question--Is this only an American thing or you welcome partners of same thing beyond your boarders?? I would be keen to link into you because this project mirrors our project that aims to work on revenge and promote cohesion between different school of thinking...</p>
                <span class="author">Nkata, <span class="progressive">PROGRESSIVE</span> from London</span>
            </div>
            <div class="single-testimonial">
                <p>Great message that seems to offer a fair and balanced approach to many of our biggest challenges that keep us from coming together as a the great nation that we are. It's our innovation that has made us what we are time and time again, this may be just the innovation that we need to get back to greatness, once again! </p>
                <span class="author">Travis Jenkins, <span class="republican">REPUBLICAN</span> from Kingwood, Tx</span>
            </div>
            <div class="single-testimonial">
                <p>I wish we could have a third party. I do not like either party at this point. We need to have a party that is moderate and does what is best for our country, not just themselves.</p>
                <span class="author">Naomi Girts-Signs, <span class="thirdparty">3RD-PARTY</span> from Toledo, OH</span>
            </div>
            <div class="single-testimonial">
                <p>We need this, very badly. I can't take too much more extremism on either side, but especially the digging in of the wealthiest to become even more wealthy. This gives me hope.</p>
                <span class="author">Grace, <span class="independent">INDEPENDENT</span> from Dumfries, VA</span>
            </div>
            <div class="single-testimonial">
                <p>This has potential.....need more details because that is where the devil is....</p>
                <span class="author">Craig, <span class="libertarian">LIBERTARIAN</span> from Pittsburgh PA</span>
            </div>
            <div class="single-testimonial">
                <p>The concept is excellent, how do we break through the powerful political process and the slanted media to even have a chance at presenting the win-win-win concept?</p>
                <span class="author">John Hashek, <span class="republican">REPUBLICAN</span> from Fort Myers Beach, FL</span>
            </div>
            <div class="single-testimonial">
                <p>I like your ideas, but will it work!!!! </p>
                <span class="author">John Dixon, <span class="democrat">DEMOCRAT</span> from Fort Lauderdale, Florida</span>
            </div>
            <div class="single-testimonial">
                <p>Yes, I believe in this and think it would be a great idea. We definitely need unity in Congress and the Presidential administration with the people not against it.</p>
                <span class="author">Donna Patty, <span class="republican">REPUBLICAN</span> from Bensalem PA</span>
            </div>
            <div class="single-testimonial">
                <p>It seems to be a clear, to the point solution. </p>
                <span class="author">Don Hill, <span class="libertarian">LIBERTARIAN</span> from San Diego, Ca. </span>
            </div>
            <div class="single-testimonial">
                <p>I left the REPUBLICAN party for the same reason I left the Democratic party - because they left me. Transparency has been an illusion and the promise of fairness a bogus lure. This is a good start at reform, but as long as our legislators exempt themselves from the laws they make for all of us to live by, we remain their subjects. Again, this is a good start, but any real success will begin when our elected officials have to live under the laws they create and we live by. </p>
                <span class="author">Wallace Goodey, <span class="independent">INDEPENDENT</span> from Pearl River, Louisiana</span>
            </div>
            <div class="single-testimonial">
                <p>This makes sense. I really believe we have gotten away from our true values of loving our neighbors with all the greed and me-ism in this country, especially in the government where we elect these politicans to represent our voice in Washington and they get swayed by all the special interest groups leaving us high and dry. We really need to come together in this country and help one another every day and not just when there is a tragedy like 9-11. I like what Rick has to say and I support it. I hope we can make it happen.</p>
                <span class="author">Phyllis Harlow, <span class="democrat">DEMOCRAT</span> from Palmdale, CA </span>
            </div>
            <div class="single-testimonial">
                <p>Not so sure this isn't just more REPUBLICAN slanted jargon that really isn't for "everyone" but for certain of us. </p>
                <span class="author">Dr. Andrea Andrews, <span class="democrat">DEMOCRAT</span> from Fresno, Tx</span>
            </div>
            <div class="single-testimonial">
                <p>We need to have a patriotic bond that stiches us together as caring and responsible Americans. Our fore fathers sacrificed and died for our American way of life. if we want to sustain our freedoms and democracy then we need to help one another to bring America to the top of the list once again and the solution looks like our remedy. Political views mean nothing if our country looses it's basic constitutional values and tenents. God Bless America.</p>
                <span class="author">Harry Hendrickson, <span class="republican">REPUBLICAN</span> from Airville</span>
            </div>
            <div class="single-testimonial">
                <p>This actually looks like change we can believe in, not the change we got three years ago. </p>
                <span class="author">Richard, <span class="republican">REPUBLICAN</span> from Gresham, Oregon</span>
            </div>
            <div class="single-testimonial">
                <p>What a great opportunity!! Finally a government for the people!</p>
                <span class="author">Jo Rogge, <span class="independent">INDEPENDENT</span> from Oak Harbor WA</span>
            </div>
            <div class="single-testimonial">
                <p>Great idea, but needs someone to take it and sell it to the American people. </p>
                <span class="author">Delbert Hawley, <span class="independent">INDEPENDENT</span> from Hurricane</span>
            </div>
            <div class="single-testimonial">
                <p>THIS IS A GREAT REVOVUTION FOR 2011, SINCE WE HAVE BEEN OFF THE TRACK THIS SOLUTION IS ONE OF MY FAIR WAYS OF DOING THINGS IN LIFE,ITS GOOD PRINCIPALS IT'S WELL DEFINE TO UNDERDTAND SINCE WE NEED WORK AS A TEAM FOR THE SAKE OF THE FUTURE & THE CHILDREN IS THE FUTURE,WISDOM&UNDERSTANDING IT BELEIVE IT THROUGH OUT HISTORY WE CAN SEE IT WORKS,CAUSE HONESTY,INTERGRITY,LOVE,GENEROUSITY IS FROM GOD AS CHRISTJESUS TEACHINGSJOHN10:10,I PRAY THAT PEOPLE SHOULD KNOW THE TRUTH TRUTH WILL SET THEM FREE, THE TRUTH IS HOPE, PROVERB13:22/GALATIANS3:13/3JOHN2/ THESE ARE TRUE HISTORY OF SUPERNATURAL PROVISIONS EARLY KINGS LIKE DAVID SAID PSALM35:27!!!! HAVE & TRUST!!!! REMEMBER THIS IAM NOT A NATURAL CITIZEN YET BUT SPIRITUAL ONE I PAID MY TAX OH MAN ITS NOT PLEASANTS ESPECIALLY WITH LOW INCOME!!!</p>
                <span class="author">SHAIYEN JAUNKY, <span class="republican">REPUBLICAN</span> from LAGUNA NIGUEL</span>
            </div>
            <div class="single-testimonial">
                <p>Good idea, in fact the best I've heard about politics since long. </p>
                <span class="author">Johannes, <span class="independent">INDEPENDENT</span> from Malaga /Spain/ Europe</span>
            </div>
            <div class="single-testimonial">
                <p>I'm from Croatia and I support the solution. I'm <span class="independent">INDEPENDENT</span> and I believe it's a good solution for my country, too. </p>
                <span class="author">Nada , <span class="independent">INDEPENDENT</span> from Sisak in Croatia Europe</span>
            </div>
            <div class="single-testimonial">
                <p>Great Idea... kudos... I love the balance, collaboration & win-win for all</p>
                <span class="author">Vasudev Nagaraj, <span class="thirdparty">3RD-PARTY</span> from Bangalore, India</span>
            </div>
            <div class="single-testimonial">
                <p>The simplicity of the concept is too good to be true. With everyone's cooperation, it can stop the madness between the democats and the republicans that is tearing our nation apart. </p>
                <span class="author">Ed Sepulveda, <span class="thirdparty">3RD-PARTY</span> from Pico Rivera, CA</span>
            </div>
            <div class="single-testimonial">
                <p>With out personal responsibility there can be no acceptable version of social justice. Government is a terrible vehicle for social justice because there is no acceptable definition of social justice. Charity should not be a function of government. It is a personal choice that is handled much better by churches and other social organizations that can make demands on recipients that government cannot. Self sacrifice by people on the right is what creates individual success where as what the left want is group sacrifice with out a choice as to who is helped. </p>
                <span class="author">J.C. Youngberg, <span class="republican">REPUBLICAN</span> from Grand Forks, ND</span>
            </div>
            <div class="single-testimonial">
                <p>Absolutely astounding idea.... I am still astonished by this concept</p>
                <span class="author">Jeffrey Betsch, <span class="republican">REPUBLICAN</span> from Winnsboro, SC</span>
            </div>
            <div class="single-testimonial">
                <p>Finally! Someone came up with an inclusive way to look at the realities of politics and society. In Revolutionary times, Ben Franklin said, "We must all hang together or most assuredly we will all hang separately." We may have come back to that situation, and this looks like a possible resolution to our quandry.</p>
                <span class="author">Leon Tarrant, <span class="democrat">DEMOCRAT</span> from Galena, KS</span>
            </div>
            <div class="single-testimonial">
                <p>Rick is definitely and idealist. This is simple, amazing, and what makes this stand out to me is that it could work more easily than some of the ideas than I or anyone else has had.</p>
                <span class="author">Joshua Barrett, <span class="libertarian">LIBERTARIAN</span> from South Williamsport, PA</span>
            </div>
            <div class="single-testimonial">
                <p>I think this program has the potential to lie the groundwork for a Revolution!</p>
                <span class="author">K Lebens, <span class="republican">REPUBLICAN</span> from Big Bear Lake, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Getting a different result cannot be achieved with the traditional thinking that produces our current result. To transcend the present results, most of the current politicians and bureaucrats will have to be replaced with people capable of believing in and implementing new ideas and methods. Transcendent results require replacement of status quo.</p>
                <span class="author">Bruce Raymond Wright, <span class="libertarian">LIBERTARIAN</span> from Simi Valley Ca.</span>
            </div>
            <div class="single-testimonial">
                <p>It is time for people to demand transparency from their elected officials. This may be an effective start. This may be the creative, Internet-generation solutions we all know is somehow possible. This may diminish the power of special interest groups (left and right) that work again most of us. The current Dem/Reb system is broken and this may be a first step towards a fix.</p>
                <span class="author">John J. Woods, <span class="independent">INDEPENDENT</span> from Saint Louis, MO</span>
            </div>
            <div class="single-testimonial">
                <p>Neither party in change will ever create what everyone is looking for..why? When Politicians start their careers the probably mean well but after they achieve office somewhere all those lofty goals go out of the window. It now become....to some a little to most a lot..What is it it for me. Don't you find it ironic that most after a few years in office become multimillionaires. They could care less about the average working person , in fact that is exactly the problem there is no right or left fighting for their ideals. They are all fighting for the mighty dollar. Who ever they get it from is their master and has their vote. The average person is average because he doesn't have enough dollars to get and hold their interest and there fore gets the other end ..the shaft. They should all be put out and we should start all over agaan</p>
                <span class="author">Gilberto Bello, <span class="independent">INDEPENDENT</span> from Dover, New Jersey</span>
            </div>
            <div class="single-testimonial">
                <p>I *LOVE* the critical thinking that you've invested into this, and I am absolutely an ally & proponent. Let's make this happen!</p>
                <span class="author">Dave, <span class="libertarian">LIBERTARIAN</span> from Kirkland, WA</span>
            </div>
            <div class="single-testimonial">
                <p>I love it lets do it. seems to be a mutually beneficial circular supported system that continually feeds itself.</p>
                <span class="author">Dawson, <span class="independent">INDEPENDENT</span> from Aurora CO</span>
            </div>
            <div class="single-testimonial">
                <p>Finally a solution free of the Politics of Fear!!! I support and vote for the candidates that create the most hope (even if it is unfounded), because if we as a country lose hope... it's Game Over. Thanks Rick, the Solution is a unifying step in the right direction, offering Real Hope. Count me on board.</p>
                <span class="author">Steve, <span class="libertarian">LIBERTARIAN</span> from beautiful St George, UT</span>
            </div>
            <div class="single-testimonial">
                <p>Very Impressed with thes program</p>
                <span class="author">Thomas Moulding, <span class="republican">REPUBLICAN</span> from Scotts Valley, CA</span>
            </div>
            <div class="single-testimonial">
                <p>Any thing that will reduce the size of government, I am for. Add the fact that you are looking at ways to improve government spending and you really have some thing.</p>
                <span class="author">Paul, <span class="republican">REPUBLICAN</span> from Grand Junction/ CO</span>
            </div>
            <div class="single-testimonial">
                <p>The simplicity of the message and its diverse appeal.</p>
                <span class="author">Hugh, <span class="libertarian">LIBERTARIAN</span> from McCoy</span>
            </div>
            <div class="single-testimonial">
                <p>Although I'm a Life Long Democrat, being indoctrinated long ago on my riding Daddy's shoulders at a Labor day parade in 1959, Then Senator Kennedy waved at me.... But what I'm saddened by in 2011 is the rabid "Us vs Them" viciousness. What I love about Rick's WinWin is it's carefully thought out way for us to Help others have HOPE and OPPORTUNITY....a True WIN-WIN to WINBIG!</p>
                <span class="author">Gregory, <span class="democrat">DEMOCRAT</span> from Detroit, Michigan</span>
            </div>
            <div class="single-testimonial">
                <p>Liberalism and the progressive movement are proven disastrous failures.They are also antithetical to our founding and our blood-bought constitutional freedoms.I worry that though we could somehow limit government spending and regulating that there's still going to always be that intrinsic sinister philisophical anti capitalist conspiritorial lunacy from the Godless left. Social morality cannot be left out of the equation, I'm afraid. For example, why preach to the Right about forcing our morality on the Left then turning right around and forcing Obamacare by fiatt on over 70% of Americans who opposed it or making Pro-Life Christians fund Planned Parenthood's yearly slaughter of millions of our most innocent citizens? Our constitution, which by the way, the Commander in Chief is sworn to uphold, should well have been all that was necessary to have prevented either one of these two unspeakable horrors from ever getting close to becoming reality...but they are and I fail to see how this kind of evil will be averted with the Solution. What do you bet that the Cap-and-Prioritize thing you spoke of wouldn't turn out just like Obama's response to Paul Ryan's proposed budget? Here he has a half billion cut from Medicare in his Obamacare monstrosity and the liberal media very conveniently shields him from the American people while simutaneously carrying his water as he chides Ryan and republicans for being out to "get old people". I do, however, appreciate your concept and passion!</p>
                <span class="author">Mark, <span class="republican">REPUBLICAN</span> from Granite Falls, NC</span>
            </div>
            <div class="single-testimonial">
                <p>I think most americans are in the middle ... this seems to address the middle instead of the far rights and lefts.</p>
                <span class="author">Ellie, <span class="independent">INDEPENDENT</span> from NY</span>
            </div>
            <div class="single-testimonial">
                <p>Why should our government have less accountability than each family ?? Families do well when they spend wisely *while* taking care of each other. What happens when the people work together like one big family, spending on top priorities first?</p>
                <span class="author">Lori, <span class="libertarian">LIBERTARIAN</span> from NC</span>
            </div>
            <div class="single-testimonial">
                <p>Here is a complex problem solved with profound understanding, wisdom, and vision. A clear presentation of the concept and answers -conveyed in an understandable way; in less than 20 minutes to a major part of the literate and understanding world. Tremendous ideas from your THINK TANK with well thought out steps for implementation. Sure beats everything out there proposed so far and indeed could allow for a peaceable transforming power helping to get it done. Let's all pray together moving this forward so peace will prevail before the Lord Jesus returns. MARANATHA. </p>
                <span class="author">NOEL HINMAN, <span class="thirdparty">3RD-PARTY</span> from MERRILLVILLE, INDIANA</span>
            </div>
            <div class="single-testimonial">
                <p>I am so SICK of the political fighting and bickering - let's have a real "transparent" government for ONCE! </p>
                <span class="author">Rick, <span class="republican">REPUBLICAN</span> from Lenexa, Ks</span>
            </div>
            <div class="single-testimonial">
                <p>Rick is in charge. and it makes sense... mostly ... a couple of words here or there... I like the presentation and the convergence of Charityism with Capitalism. Although, I think there is a better word for charitism. </p>
                <span class="author">Steve, <span class="thirdparty">3RD-PARTY</span> from SLC, UT</span>
            </div>
            <div class="single-testimonial">
                <p>A complex problem solved with profound understanding; with an understandable answer and concept that can be clearly conveyed in less than 20 minutes to a large part of the world.</p>
                <span class="author">NOEL, <span class="thirdparty">3RD-PARTY</span> from MERRILLVILLE, INDIANA</span>
            </div>
            <div class="single-testimonial">
                <p>I was raised a republican, but have become so disenchanted and even embarrassed by the greed and ego displayed by the republican party, I was headed to the Democratic side which focuses on helping people. What I want most is Common Sense and Business Sense in govt. I would vote for a business leader any day over a political leader. This country needs someone who can run the gov't like a business... focused on results... that can be responsible for reaching a positive bottom line... that treats it's citizens like customers - with dignity and respect. I love the solution platform and philosophy! Rick does a superb job of explaining it! I would love to see him run for president! We would finally have someone in office with business and common sense. But if that isn't an option, then I would support whoever supports this philosophy. Right now Trump is the only business person running (or about to). I hope we will see others from the business community step up to the plate from both REP & DEM parties - who support the Solution platform. Maybe it will even gain traction as a third political party - one everyone can buy into, and we will enter a new era of collaboration where we support each other and everyone wins, instead of competition where we destroy each other, very few win, and those who do, do so at the expense of everyone else. I support the idea of competition as Rick intends it, where it is an exercise in bringing the best out in people and organizations... where people compete to be the best and offer the most value to others. I don't support the idea of competition in which there are winners and losers, and operates on the theory of scarcity. I am sooo happy to see the emergence of a true win-win platform. It is needed more now than ever before. Thank you Rick!</p>
                <span class="author">Kim, <span class="independent">INDEPENDENT</span> from Reno, NV</span>
            </div>
            <div class="single-testimonial">
                <p>I really hope something like this can actually happen. I will show my support, for what it is worth. Transparency is the key and no one in Washington seems to want that to happen right now. Lets change that and really see how bad the waste is, then I will gladly pay a fair share of the taxes we need.</p>
                <span class="author">Danny, <span class="libertarian">LIBERTARIAN</span> from Franklin, TN</span>
            </div>
            <div class="single-testimonial">
                <p>Wow, This plan can really work... Thank you Rick... this Rocks!</p>
                <span class="author">Maine Bob, <span class="independent">INDEPENDENT</span> from South China, Maine</span>
            </div>
            <div class="single-testimonial">
                <p>It is a new look at where we can go from here. I will save any other comment until after I have viewed the manifesto after it is emailed to me.</p>
                <span class="author">Alan, <span class="independent">INDEPENDENT</span> from Lebanon, NH</span>
            </div>
            <div class="single-testimonial">
                <p>The Solution is the first time I've felt hope that Americans might stop talking past each other, embrace the heart of where we agree, and do something that makes sense.</p>
                <span class="author">Patti , <span class="republican">REPUBLICAN</span> from Dallas, TX</span>
            </div>
            <div class="single-testimonial">
                <p>WWR is a sincere and thoughtful new approach to solving our biggest political ills. I'd encourage anyone to set aside blind ideological loyalty and cynicism for at a moment and consider this call to unity.</p>
                <span class="author">Scott, <span class="progressive">PROGRESSIVE</span> from CA</span>
            </div>
            <div class="single-testimonial">
                <p>Finally we have a WIN solution</p>
                <span class="author">Rene, <span class="democrat">DEMOCRAT</span> from Phoenix Arizona</span>
            </div>
            <div class="single-testimonial">
                <p>Representative democracy has long outlived its usefulness. It is time for direct democracy and professional management to take over from the "best congress money can buy" institutions. TheSolution is a reasonable middle ground that might allow us to transition from one to the other without a full civil war we might otherwise soon get into.</p>
                <span class="author">Martin, <span class="libertarian">LIBERTARIAN</span> from Carson City, NV</span>
            </div>
            <div class="single-testimonial">
                <p>Transparency is the key to reduce the backroom shenanignans in government spending & contracts. Greed on a level playing field is different than greed in a dishonest good old boys network.</p>
                <span class="author">E. Thomas, <span class="democrat">DEMOCRAT</span> from Naples, FL</span>
            </div>
            <div class="single-testimonial">
                <p>What a well presented idea/concept. Thank you Rick!</p>
                <span class="author">Tim, <span class="republican">REPUBLICAN</span> from Greenwich CT</span>
            </div>
            <div class="single-testimonial">
                <p>Let's build common ground where we can. If we presume that others have good intentions we can make tremendous progress.</p>
                <span class="author">Steven, <span class="independent">INDEPENDENT</span> from Mountain View, CA</span>
            </div>
            <div class="single-testimonial">
                <p>The Solution is a noble concept and strategy as far as it goes. However, special interests will still buy favor from greedy politicians to move their cause up the priority list. The influence of special interests, the extreme polarization of political parties with no middle ground and the use of personal demonizing all have to be reversed. To do so, politics has to be transformed back to the intent of the founding fathers: politicians who are *temporary* office holders - from all walks of life - motivated by the desire to improve our country, rather than "career politicians" - in office for decades - whose desire for control, power and longevity makes them vulnerable to polarization, greed and corruption.</p>
                <span class="author">Terry, <span class="independent">INDEPENDENT</span> from Seattle WA</span>
            </div>
            <div class="single-testimonial">
                <p>This makes total sense because none of us can achieve a sustainable program that will please everyone without compromise and working synergistically to make our government work for all. I'm all for transparency because evil can only hide in the dark. If all men let their lights shine, there cannot be any darkness. I have only been interested in shining the light on the evil that permeates our govenment today. Very few people would choose evil if they know it to be evil. I'm all for the Solution. I know that when you understand what it is and how it works, you will support this too!</p>
                <span class="author">Mae , <span class="republican">REPUBLICAN</span> from Las Vegas, NV</span>
            </div>
            <div class="single-testimonial">
                <p>Real possibilities to move all our political sides forward together for a greater future for all. No one group owns the word "patriotic." Anyone that cares about our country’s past, present and future gets to claim this word. This Solution gives me hope for our country’s future and our country’s ability to be a positive, collaborative, constructive energy for Good in the world.</p>
                <span class="author">Monica, <span class="independent">INDEPENDENT</span> from Seattle, Wa</span>
            </div>
            <div class="single-testimonial">
                <p>Not until we redefine the role of government in our lives will we begin to rebuild our country to be the greatest in the world again (sorry, communists & socialists...). This Solution is a fantastic idea that truly has the potential to redefine our government. I wholeheartedly support this concept and the people behind the idea.</p>
                <span class="author">John, <span class="republican">REPUBLICAN</span> from Cleveland, OH</span>
            </div>
            <div class="single-testimonial">
                <p>Finally a common sense solution to our political gridlock!</p>
                <span class="author">Ted, <span class="independent">INDEPENDENT</span> from San Anselmo, CA</span>
            </div>
            <div class="single-testimonial">
                <p>It's logical. It simply makes sense. Plus, it holds government accountable for their spending. </p>
                <span class="author">Gil, <span class="libertarian">LIBERTARIAN</span> from Riverdale NY</span>
            </div>
            <div class="single-testimonial">
                <p>That there seems to be a complete and sensible plan on how to bring us together to resolve where we are. I am of the opinion that democracy as we are practicing it does not work. To continue the present will eventually destory us. </p>
                <span class="author">Rey, <span class="independent">INDEPENDENT</span> from Boston</span>
            </div>
            <div class="single-testimonial">
                <p>Very well done Rick! As a political conservative, I am disheartened by the divisive rhetoric tearing at our great Nation. The Solution certainly presents a possibility to reverse the destructive course we are on. I look forward to and welcome additional information which will empower me to educate others! Lets be sure to create links to each other in local areas. I would be agreeable to assist in organizing and leading in the South Florida region. My best to you, Philip </p>
                <span class="author">Philip, <span class="republican">REPUBLICAN</span> from Sunny Isles Beach, Florida</span>
            </div>
            <div class="single-testimonial">
                <p>Very well done Rick! As a political conservative, I am disheartened by the divisive rhetoric tearing at our great Nation. The Solution certainly presents a possibility to reverse the destructive course we are on. I look forward to and welcome additional information which will empower me to educate others! Lets be sure to create links to each other in local areas. I would be agreeable to assist in organizing and leading in the South Florida region. My best to you, Philip </p>
                <span class="author">Philip, <span class="republican">REPUBLICAN</span> from Sunny Isles Beach, Florida</span>
            </div>
            <div class="single-testimonial">
                <p>Rick is a modern day philosopher who understands how altruistic ideas can be arranged appeal to everyone. This WWR construct will need a lot of help to gain traction. However, it can be "sold" like soap, cars, or fashion by clever people. This could work.</p>
                <span class="author">John, <span class="libertarian">LIBERTARIAN</span> from Georgia</span>
            </div>
            <div class="single-testimonial">
                <p>This idea has potential. The devil is always in the details. I joined and will follow this with great interest.</p>
                <span class="author">Doug, <span class="libertarian">LIBERTARIAN</span> from Santa Ana, CA</span>
            </div>
            <div class="single-testimonial">
                <p>This is the very definition of highest and greatest good of all.</p>
                <span class="author">Don, <span class="independent">INDEPENDENT</span> from Levelland, TX</span>
            </div>

            <div class="single-testimonial">
                <p>The Solution is a concept and party change that I fully support. This is THE way to demonstrate for us and our future generations what right looks like!</p>
                <span class="author">Mark, <span class="thirdparty">3RD-PARTY</span> from St. Robert, Missouri</span>
            </div>
            <div class="single-testimonial">
                <p>My gut response to this can be described in one word: RESPONSIBILITY. That's what Rick is introducing/demanding with this approach. Transparency is the precurser and guarantor of responsibility. But, we can no longer just talk about it. We're on the slippery slope to destruction. Goofy is strapped to his skis and gaining speed down that mountain ... we must do something before he turns into that huge snowball and crashes! Transparency. Cap and prioritize. What a concept! Why do I like it? Responsibility. Capitalism feeds charityism. Where does charity get funded without the freedom to invent, produce, earn, profit, and serve? Yep, charity and business are two sides of the same coin. We must maintain the balance of powers, the natural give and take, without favoring one side over the other. Transparency and Responsibility. Go for it Rick! </p>
                <span class="author">Mel, <span class="thirdparty">3RD-PARTY</span> from Carson City, NV</span>
            </div>
            <div class="single-testimonial">
                <p>I do not fit your boxed in choices for political view, but you are forcing me into YOUR views in order to be heard. I also think that you are not taking into account "invest and grow" only cap. I believe that you have naively overlooked the determination of a select party to survive as a party at all costs...(oooh do not think that you know what is on my voter reg card either) - ALL costs to you, me and the law. If we had not increased our spending and invested during these past few years, our business and us would not have survived...instead we did invest, we grew and are thriving. </p>
                <span class="author">Sherry, <span class="independent">INDEPENDENT</span> from Deland, FL</span>
            </div>
            <div class="single-testimonial">
                <p>This is exactly what I've been looking for - people trying to agree rather than fight. Great ideas.</p>
                <span class="author">Robert, <span class="independent">INDEPENDENT</span> from Bellingham/WA</span>
            </div>
        </div>
    </div>

<script type="text/javascript">
    jQuery("a.fancy").fancybox({
        'titleShow'         : false,
        'overlayOpacity'    : 0.4,
        'centerOnScroll'    : true,
        'showCloseButton'   : false,
        'type'              : 'ajax',
        hideOnOverlayClick  : true,
        'closeClick': true
    });


    var flashvars = {};

    var params = {};

    var attributes = {};


    jQuery(document).ready(function(){

        flashvars.image = "";
        flashvars.autoplay = "true";
        flashvars.loop = "false";
        flashvars.autohide = "true";
        flashvars.fullscreen = "true";
        flashvars.color_text = "0xFFFFFF";
        flashvars.color_seekbar = "0xeb1515";
        flashvars.color_loadingbar = "0x828282";
        flashvars.color_seekbarbg = "0x333333";
        flashvars.color_button_out = "0x333333";
        flashvars.color_button_over = "0x000000";
        flashvars.color_button_highlight = "0xffffff";
        params.wmode = "opaque";

        params.allowfullscreen = "true";
        params.allowscriptaccess = "always";
        params.bgcolor = "#000000";

        if (!$.browser.ie) {
            jQuery(this).find('#video').html('<iframe width="600" height="337" src="http://www.youtube.com/embed/HieF3DuBFdg?&vq=hd1080&autohide=1&controls=0&modestbranding&rel=0&showinfo=0&autoplay=1&wmode=transparent" frameborder="0" allowfullscreen></iframe>');
        } else {
            jQuery(this).find('#video').html('<object width="600" height="337"><param name="movie" value="http://www.youtube.com/v/HieF3DuBFdg?vq=hd1080&amp;version=3&amp;autohide=1&amp;controls=0&amp;modestbranding&amp;rel=0&amp;showinfo=0&amp;autoplay=1&amp;wmode=transparent"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/HieF3DuBFdg?vq=hd1080&amp;version=3&amp;autohide=1&amp;controls=0&amp;modestbranding&amp;rel=0&amp;showinfo=0&amp;autoplay=1&amp;wmode=transparent" type="application/x-shockwave-flash" width="600" height="337" allowscriptaccess="always" allowfullscreen="true"></embed></object>');
        }


        attributes.align = "middle";

        //getTestimonials();
		jQuery('.video-wrapper').click(function(){
            if (!$.browser.ie) {
                jQuery(this).find('#video').html('<iframe width="600" height="337" src="http://www.youtube.com/embed/HieF3DuBFdg?&vq=hd1080&autohide=1&controls=0&modestbranding&rel=0&showinfo=0&autoplay=1&wmode=transparent" frameborder="0" allowfullscreen></iframe>');
            } else {
                jQuery(this).find('#video').html('<object width="600" height="337"><param name="movie" value="http://www.youtube.com/v/HieF3DuBFdg?vq=hd1080&amp;version=3&amp;autohide=1&amp;controls=0&amp;modestbranding&amp;rel=0&amp;showinfo=0&amp;autoplay=1&amp;wmode=transparent"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/HieF3DuBFdg?vq=hd1080&amp;version=3&amp;autohide=1&amp;controls=0&amp;modestbranding&amp;rel=0&amp;showinfo=0&amp;autoplay=1&amp;wmode=transparent" type="application/x-shockwave-flash" width="600" height="337" allowscriptaccess="always" allowfullscreen="true"></embed></object>');
            }
            /*flashvars.autoplay = "true";
            flashvars.movie = "/video/main_small.mov";
            swfobject.embedSWF("/js/player.swf", "video", "600", "337", "9.0.45", "", flashvars, params, attributes);*/

        });
        jQuery('.radio_list li input[type="radio"]').each(function(){
            var NewContainer = document.createElement('div'),
                newSpan = document.createElement('span');
            NewContainer.className = 'fake-radio';
            jQuery(NewContainer).insertAfter(this);
            jQuery(NewContainer).append(this);
            jQuery(NewContainer).append(newSpan);

            if ( jQuery(this).attr('checked') == 'checked' ) {
                jQuery(this).parent().find('span').addClass('checked');
            }
        });

        jQuery('.fake-radio span').click(function(){
            jQuery(this).parent().find('input[type="radio"]').attr('checked', true);
            jQuery(this).parent().parent().parent().find('span').removeClass('checked');
            jQuery(this).parent().find('span').addClass('checked');
        });
    });

    function getTestimonials(){
        jQuery.ajax({
            url: "<?php echo url_for('@get_testimonials'); ?>",
            type: "get",
            dataType: "json",
            async: true,
            cache: false,
            success: function(data){
                if(data.length > 0){
                    for(var i = 0; i < data.length; i++){
                        
                        getLiWithMinHeight().append(""+
                            '<div class="single-testimonial">'+
                                '<p>'+data[i]['text']+'</p>'+
                                '<span>'+data[i]['name']+'</span>'+
                            '</div>'
                        );
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert(textStatus);
            }
        });
    }

    function getLiWithMinHeight(){
        var min_height = 9999;
        var min_li = jQuery(".testimonials-list li").first();
        jQuery(".testimonials-list li").each(function(){
            if(jQuery(this).height() < min_height){
                min_height = jQuery(this).height();
                min_li = jQuery(this);
            }
        });
        return min_li;
    }
</script>

