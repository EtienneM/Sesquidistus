-- phpMyAdmin SQL Dump
-- version OVH
-- http://www.phpmyadmin.net
--
-- Client: mysql5-1.90
-- Généré le : Mer 11 Juillet 2012 à 23:55
-- Version du serveur: 5.0.90
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `frisbeesfris2`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id_album` int(11) NOT NULL auto_increment,
  `nom_album` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_album`),
  UNIQUE KEY `nom_album` (`nom_album`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Contenu de la table `albums`
--

INSERT INTO `albums` (`id_album`, `nom_album`) VALUES
(15, '2009 05 31 Faulquemo'),
(1, 'default'),
(39, 'Interflug 2011'),
(41, 'Keep Your Mustache 2'),
(46, 'KYM\\''12'),
(13, 'Molsheim 2009'),
(43, 'Photos du site'),
(40, 'Photos d\\''Ã©quipes'),
(45, 'Prague Winter '),
(42, 'Saverne 2008 '),
(36, 'Urban Free\\''Z Beach ');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL auto_increment,
  `titre` text NOT NULL,
  `contenu` text NOT NULL,
  `date_article` date NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `contenu`, `date_article`, `id_event`, `id_member`) VALUES
(19, 'Test', '<p>L''<em><strong>Ultimate</strong></em> (ou &laquo;&nbsp;ultime-passe&nbsp;&raquo; pour la <a class="mw-redirect" title="DGLF" href="http://fr.wikipedia.org/wiki/DGLF">DGLF</a>) est un <a title="Sport" href="http://fr.wikipedia.org/wiki/Sport">sport</a> collectif utilisant un disque volant, ou <a title="Frisbee" href="http://fr.wikipedia.org/wiki/Frisbee">frisbee</a> (marque d&eacute;pos&eacute;e), opposant deux &eacute;quipes de sept joueurs. L''objectif est  de marquer des points en progressant sur le terrain par passes  successives vers la zone d''en-but adverse et d''y r&eacute;ceptionner le disque.  L''Ultimate se pratique dans sa version la plus courante sur terrain en  herbe &agrave; l''ext&eacute;rieur (7 contre 7), mais peut aussi se pratiquer sur un  terrain de handball (int&eacute;rieur, 2 &eacute;quipes de 5 joueurs), ou sur la plage  (5 contre 5 ou 4 contre 4). Les r&egrave;gles sont l&eacute;g&egrave;rement am&eacute;nag&eacute;es  lorsqu''on souhaite le pratiquer en gymnase ou sur plage. On y retrouve  plusieurs divisions&nbsp;: hommes, femmes, mixte (4 hommes/3 femmes ou 4  femmes/3 hommes). Il existe &eacute;galement des divisions selon les &acirc;ges&nbsp;:  junior et maitre.</p>\r\n<p>L&rsquo;Ultimate se pratique &eacute;galement dans une version adapt&eacute;e aux personnes handicap&eacute;es physiques: on l&rsquo;appelle l&rsquo;<a title="Ultimate Fauteuil" href="http://fr.wikipedia.org/wiki/Ultimate_Fauteuil">Ultimate Fauteuil</a>.</p>\r\n<p>&nbsp;</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" title="SESQUIDISTUS" src="http://ffindr.com/uploads/images/items/60fd2ae8180d98972ce4f857be0fd9bc8bb90c1d.jpg" alt="" width="500" height="347" /></p>', '2010-11-27', 1, 2),
(20, 'Logo d''Ultimate', '<p><span style="text-decoration: underline;">Exemple de logo Ultimate:</span></p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" title="logo" src="http://avoca37.org/mmpe/files/2008/08/frisbee_000.gif" alt="Logo" width="200" height="222" /></p>', '2010-11-27', 4, 2),
(21, 'Test 34', '<p>Nouveau Test</p>\r\n<p>&nbsp;</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/groupe%20apr%C3%A8s%20remise%20des%20prix.jpg" alt="" width="500" height="334" /></p>', '2010-12-02', 1, 1),
(22, 'Présentation Ultimate', '<p>L''<em><strong>Ultimate</strong></em> (ou &laquo;&nbsp;ultime-passe&nbsp;&raquo; pour la <a class="mw-redirect" title="DGLF" href="http://fr.wikipedia.org/wiki/DGLF">DGLF</a>) est un <a title="Sport" href="http://fr.wikipedia.org/wiki/Sport">sport</a> collectif utilisant un disque volant, ou <a title="Frisbee" href="http://fr.wikipedia.org/wiki/Frisbee">frisbee</a> (marque d&eacute;pos&eacute;e), opposant deux &eacute;quipes de sept joueurs. L''objectif est  de marquer des points en progressant sur le terrain par passes  successives vers la zone d''en-but adverse et d''y r&eacute;ceptionner le disque.  L''Ultimate se pratique dans sa version la plus courante sur terrain en  herbe &agrave; l''ext&eacute;rieur (7 contre 7), mais peut aussi se pratiquer sur un  terrain de handball (int&eacute;rieur, 2 &eacute;quipes de 5 joueurs), ou sur la plage  (5 contre 5 ou 4 contre 4). Les r&egrave;gles sont l&eacute;g&egrave;rement am&eacute;nag&eacute;es  lorsqu''on souhaite le pratiquer en gymnase ou sur plage. On y retrouve  plusieurs divisions&nbsp;: hommes, femmes, mixte (4 hommes/3 femmes ou 4  femmes/3 hommes). Il existe &eacute;galement des divisions selon les &acirc;ges&nbsp;:  junior et maitre.</p>\r\n<p>L&rsquo;Ultimate se pratique &eacute;galement dans une version adapt&eacute;e aux personnes handicap&eacute;es physiques: on l&rsquo;appelle l&rsquo;<a title="Ultimate Fauteuil" href="http://fr.wikipedia.org/wiki/Ultimate_Fauteuil">Ultimate Fauteuil</a>.</p>\r\n<p>&nbsp;</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" title="Ultimate" src="http://upload.wikimedia.org/wikipedia/fr/3/38/Vinil_tour_2005.jpg" alt="Ultimate" width="500" height="324" /></p>', '2010-12-05', 192, 6),
(23, 'Présentation de l''Ultimate', '<p>L''<em><strong>Ultimate</strong></em> (ou &laquo;&nbsp;ultime-passe&nbsp;&raquo; pour la <a class="mw-redirect" title="DGLF" href="http://fr.wikipedia.org/wiki/DGLF">DGLF</a>) est un <a title="Sport" href="http://fr.wikipedia.org/wiki/Sport">sport</a> collectif utilisant un disque volant, ou <a title="Frisbee" href="http://fr.wikipedia.org/wiki/Frisbee">frisbee</a> (marque d&eacute;pos&eacute;e), opposant deux &eacute;quipes de sept joueurs. L''objectif est  de marquer des points en progressant sur le terrain par passes  successives vers la zone d''en-but adverse et d''y r&eacute;ceptionner le disque.  L''Ultimate se pratique dans sa version la plus courante sur terrain en  herbe &agrave; l''ext&eacute;rieur (7 contre 7), mais peut aussi se pratiquer sur un  terrain de handball (int&eacute;rieur, 2 &eacute;quipes de 5 joueurs), ou sur la plage  (5 contre 5 ou 4 contre 4). Les r&egrave;gles sont l&eacute;g&egrave;rement am&eacute;nag&eacute;es  lorsqu''on souhaite le pratiquer en gymnase ou sur plage. On y retrouve  plusieurs divisions&nbsp;: hommes, femmes, mixte (4 hommes/3 femmes ou 4  femmes/3 hommes). Il existe &eacute;galement des divisions selon les &acirc;ges&nbsp;:  junior et maitre.</p>\r\n<p>L&rsquo;Ultimate se pratique &eacute;galement dans une version adapt&eacute;e aux personnes handicap&eacute;es physiques: on l&rsquo;appelle l&rsquo;<a title="Ultimate Fauteuil" href="http://fr.wikipedia.org/wiki/Ultimate_Fauteuil">Ultimate Fauteuil</a>.</p>\r\n<p>&nbsp;</p>\r\n<p><img style="border: 1px solid #333333; display: block; margin-left: auto; margin-right: auto;" title="Ultimate" src="http://upload.wikimedia.org/wikipedia/fr/thumb/3/38/Vinil_tour_2005.jpg/800px-Vinil_tour_2005.jpg" alt="Ultimate" width="500" height="324" /></p>', '2010-12-06', 196, 6),
(24, 'moustache', '<p>blabla</p>\r\n<p>&nbsp;</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" title="jhjghjghjg" src="modules/galerie/picture/Faulquemont_20090531_550.JPG" alt="jghjgh" width="500" height="333" /></p>', '2011-04-07', 197, 197),
(29, 'Affiche ', '', '2011-05-22', 201, 201),
(33, 'Affiche ', '', '2011-05-29', 201, 201),
(34, 'Affiche', '', '2011-05-29', 201, 201),
(36, 'Keep Your Mustache Come On !!', '<p style="text-align: justify;"><span style="font-size: small;">Salut les moustachus et les moustachues !</span></p>\r\n<p style="text-align: justify;">Pour f&ecirc;ter dignement le trenti&egrave;me anniversaire de la mort de Georges Brassens (chanteur fran&ccedil;ais moustachu), mais surtout pour se marrer, les Sesquidistus de Strasbourg adopteront la moustache pour un weekend de folie et de frisbee. Nous vous invitons &agrave; partager cette exp&eacute;rience exceptionnelle, <span style="color: #0000ff;">le 4 et 5  juin 2011</span> &agrave; Erstein (&agrave; 20 km au sud de Strasbourg).<br /> Nous mettons &agrave; votre disposition<span style="color: #0000ff;"> 4 terrains en herbe, un camping, hauts  parleurs et DJ et un plan d&rsquo;eau 100% naturel </span>pour vous rafraichir entre les matchs et une &eacute;quipe de gentils organisateurs qui chercheront &agrave; pousser encore plus loin leur science de l&rsquo;organisation...</p>\r\n<p><span style="text-decoration: underline;"><a title="Lien ffindr" onclick="window.open(''http://ffindr.com/fr/event/keep-your-mustache-2011'',''Keep your Mustache'',''location=yes,scrollbars=yes,menubar=yes,resizable=yes,toolbar=yes,status=yes'');return false;" href="http://ffindr.com/fr/event/keep-your-mustache-2011" target="_blank">Lien ffindr</a></span></p>\r\n<p><span style="text-decoration: underline;"><a title="Carte du site" onclick="window.open(''http://maps.google.fr/maps/ms?ie=UTF8&amp;hl=fr&amp;msa=0&amp;msid=214245597670955850799.00049eaa3611f0ba60501&amp;ll=48.413365,7.669337&amp;spn=0.003789,0.006899&amp;t=h&amp;z=17&amp;lci=com.google.webcams&gt;'','''',''location=yes'');return false;" href="http://maps.google.fr/maps/ms?ie=UTF8&amp;hl=fr&amp;msa=0&amp;msid=214245597670955850799.00049eaa3611f0ba60501&amp;ll=48.413365,7.669337&amp;spn=0.003789,0.006899&amp;t=h&amp;z=17&amp;lci=com.google.webcams" target="_blank">Vue a&eacute;rienne du site d''Erstein<br /></a></span></p>\r\n<p>&nbsp;</p>\r\n<p><img src="modules/galerie/picture/keep%20your%20musatche%20bleu.png" alt="" width="507" height="196" /></p>', '2011-05-31', 201, 201),
(39, 'Urban Free''z Beach / 2-3/07/2011', '<p><span class="Apple" style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium ''Times New Roman''; white-space: normal; orphans: 2; letter-spacing: normal; color: #000000; word-spacing: 0px;"><span class="Apple" style="border-collapse: collapse; font-family: arial, sans-serif; font-size: 13px;"><strong>L''&eacute;quipe: </strong></span></span></p>\r\n<p><span class="Apple" style="widows: 2; text-transform: none; text-indent: 0px; border-collapse: separate; font: medium ''Times New Roman''; white-space: normal; orphans: 2; letter-spacing: normal; color: #000000; word-spacing: 0px;"><span class="Apple" style="border-collapse: collapse; font-family: arial, sans-serif; font-size: 13px;"><strong><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/NJ031688.JPG" alt="" width="505" height="377" /> </strong></span></span><span style="font-size: x-small;"></span></p>\r\n<p style="text-align: center;"><span style="font-size: x-small;"><span class="Apple" style="line-height: normal; widows: 2; text-transform: none; font-variant: normal; font-style: normal; text-indent: 0px; border-collapse: separate; font-family: ''Times New Roman''; white-space: normal; orphans: 2; letter-spacing: normal; color: #000000; font-weight: normal; word-spacing: 0px;"><span class="Apple" style="border-collapse: collapse; font-family: arial, sans-serif;">De gauche &agrave; droite, de haut en bas : L&eacute;l&eacute; (supportrice), Saskia, Gilles, Tom, Jimmy (Nancy), Taner, Lau, Vlad.</span></span>&nbsp;</span></p>\r\n<p><strong>Le Format :<span class="Apple">&nbsp;</span></strong><br />11 &eacute;quipes, 4 contre 4, matchs de 25 minutes ou 15 points, Cap +1, 2 points marqu&eacute;s si point marqu&eacute; de zone &agrave; zone<span class="Apple">&nbsp;</span><br /><br /><strong>Le Spot :</strong><span class="Apple">&nbsp;</span><br />Superbe coin au milieu de nulle part, avec des terrains super sympas, un plan d''eau &agrave; 30 m&egrave;tres&nbsp;et pleins de cadeaux locaux !<span class="Apple">&nbsp;</span><br /><br /><strong>Les R&eacute;sultats :<span class="Apple">&nbsp;</span></strong><br /><em>Premi&egrave;re phase de poule :<span class="Apple">&nbsp;</span></em><br />Premier match : victoire contre la Bourrasque : 15 - 2<span class="Apple">&nbsp;</span><br />Deuxi&egrave;me match : d&eacute;faite contre les Psyk''Hot (Bab, Arthur, Kent et des anciens du Hot (Selle saint-cloud) : 4 - 11<br />Troisi&egrave;me match : victoire contre les Barbarians (Ex-Psychos) : 9 - 6<span class="Apple">&nbsp;</span><br /><em><br />Deuxi&egrave;me phase de poule (poule haute) :<span class="Apple">&nbsp;</span></em><br />Quatri&egrave;me match : victoire contre les Coed 4 Ever (une partie de l''&eacute;quipe nationale mixte belge qui ira au world beach cet &eacute;t&eacute; en Italie) : 9 - 7<br />Cinqui&egrave;me match : victoire contre les Friz''bisontins (Loys et Gaetan + des allemands de Ludwigsaffen) : 8 - 6<span class="Apple">&nbsp;</span><br />Sixi&egrave;me match : victoire contre les Barbarians : 15 - 1<br /><em><br />Demi-finale :<span class="Apple">&nbsp;</span></em><br />Septi&egrave;me match : d&eacute;faite contre les Coed Fever (deuxi&egrave;me partie de l''&eacute;quipe nationale mixte belge) : 5 - 7 (Apr&egrave;s avoir men&eacute; 4 - 1, on a un peu craqu&eacute; ... mais superbe match quand m&ecirc;me)<span class="Apple">&nbsp;</span><br /><em><br />Finale pour la troisi&egrave;me place :<span class="Apple">&nbsp;</span></em><br />Huiti&egrave;me match : d&eacute;faite contre les Coed 4 Ever : 8 - 9 (Univers point mal g&eacute;r&eacute;, surement le meilleur match du weekend, tout le monde a plong&eacute; de partout !!)<span class="Apple">&nbsp;</span><br /><br /><strong>Stats et Classements<span class="Apple">&nbsp;</span></strong>:<span class="Apple">&nbsp;</span><br />Sesquis : 5 victoires, 3 d&eacute;faites, 4 &egrave;me sur 11.<span class="Apple">&nbsp;</span><br />G&eacute;n&eacute;ral : 1. Psyk''hot, 2. Coed Fever, 3. Coed 4 Ever, 4. Sesquidistus...<br /><br /><strong>Le Spirit of the game<span class="Apple">&nbsp;</span></strong>:<span class="Apple">&nbsp;</span><br />Vraiment superbe ambiance sur et hors du terrain, &agrave; part peut &ecirc;tre en demi, o&ugrave; le Laurent qui veut gagn&eacute; n''a pas r&eacute;ussi &agrave; canaliser sa soif de victoire et s''est acharn&eacute; sur ... d&eacute;sol&eacute; Tom...&nbsp;&nbsp;Mais on est sur la bonne voie !!<span class="Apple">&nbsp;</span><br /><span style="color: #3333ff; font-size: small;"><strong>On a gagn&eacute; le SoTG (Ex aequo avec les Belges Coed Fever ) : OUIIIIIII !<span class="Apple">&nbsp;</span></strong></span>le troph&eacute;e a &eacute;t&eacute; offert &agrave; Gilles (premier tournoi oblige)<br /><br /><strong><span style="color: #000000;">Bilan :<span class="Apple">&nbsp;</span></span></strong><span style="color: #000000;"><span class="Apple">Excellent weekend,</span></span>&nbsp;on inscrit une &eacute;quipe en beach l''ann&eacute;e prochaine ?</p>\r\n<p>Pour finir merci les Psychos et &agrave; l''ann&eacute;e prochaine !!</p>', '2011-07-05', 222, 222),
(40, 'Jurassic Pack / 9-10/07/2011', '<p><strong>L''&eacute;quipe :&nbsp;</strong></p>\r\n<p><strong><img src="modules/galerie/picture/IMG_5160.JPG" alt="" width="549" height="307" /><br /></strong></p>\r\n<p style="text-align: left;"><span style="font-size: xx-small;">De gauche &agrave; droite de haut en bas : Lulu, L&eacute;l&eacute; (supportrice), Denis, Gilles, Philippe, Alban, Loic, Vlad, Tom, Lau., Hugo, Claire, G.</span></p>\r\n<p style="text-align: left;"><strong>Le Format :<span class="Apple">&nbsp;</span></strong><br /><span class="Apple">6 &eacute;quipes, match de 40 min, cap + 1.&nbsp;</span><br /><br /><strong>Le Spot :</strong><span class="Apple">&nbsp;</span><br />Terrain en bon &eacute;tat, buvette tr&egrave;s accessible, camping &agrave; 2 m&egrave;tres des terrains, bref pour leur premier tournoi les Friz''bisontins ont vraiment assur&eacute;.<br /><br /><strong>Les R&eacute;sultats </strong><span style="font-size: xx-small;">(peut &ecirc;tre quelques petites erreurs dans les scores...) </span><strong>:<span class="Apple">&nbsp;</span></strong><br /><em>Premi&egrave;re phase de mini-championnat :<span class="Apple">&nbsp;</span></em><br />Premier match : d&eacute;faite conte les TD (Tourne-Disc / Clermont) : 2 - 10&nbsp;<span class="Apple">&nbsp;</span><br />Deuxi&egrave;me match : victoire contre les Tsunamis (Seine et Marne) : 8 - 7<br />Troisi&egrave;me match : d&eacute;faite contre les Huyltimate (Huy / Belgique) : 3 - 12<span class="Apple">&nbsp;</span><br />Quatri&egrave;me match : d&eacute;faite contre les Friz''Bisontins : 7 - 11</p>\r\n<p><em>Deuxi&egrave;me phase (2 poules de 3 &eacute;quipes)&nbsp;</em><br />Cinqui&egrave;me match : d&eacute;faite contre Ultivrest (Pick Up Evrest / Ultimotte / Ultimetz) : 6 - 8&nbsp;<br />Sixi&egrave;me match : d&eacute;faite contre Huyltimate : 4 - 12&nbsp;<br /><em><br />Finale pour la 5<sup>&egrave;me</sup> / 6<sup>&egrave;me</sup> place :<span class="Apple">&nbsp;</span></em><br />Septi&egrave;me match : victoire contre les Tsunamis : 11 - 7&nbsp;<span class="Apple">&nbsp;</span><br /><br /><strong>Stats et Classements<span class="Apple">&nbsp;</span></strong>:<span class="Apple">&nbsp;</span><br />Sesquis : 2 victoires / 5 d&eacute;faites / 5<sup>&egrave;me</sup> sur 6&nbsp;<span class="Apple">&nbsp;</span><br />G&eacute;n&eacute;ral : 1. Huyltimate, 2. TD, 3. FRiz''Bisontins, 4. Ultivrest, 5. Sesquidistus, 6. Tsunamis&nbsp;<br /><br /><strong>Le Spirit of the game<span class="Apple">&nbsp;</span></strong>:<span class="Apple">&nbsp;</span><br />Apr&egrave;s une welcome tr&egrave;s tr&egrave;s tr&egrave;s aros&eacute;e par un makatchek de folie, l''&eacute;quipe a eu beaucoup de mal &agrave; se mettre en place... mais l''ambiance a toujours &eacute;t&eacute; bonne. Les Friz''bisontins remportent le SOTG, mais d&eacute;cident d''offrir le troph&eacute;e &agrave; la deuxi&egrave;me &eacute;quipe du classement : les sesquidistus !! Cool !! Le petit dinosaure et les bi&egrave;res ont pris le chemin de la r&eacute;publique tch&egrave;que... merci pour tout Vlad !!</p>\r\n<p><br /><strong><span>Bilan :<span class="Apple">&nbsp;&nbsp;</span></span></strong></p>\r\n<p><span class="Apple">L''objectif &eacute;tait d''aligner deux &eacute;quipes dans deux tournois dans le m&ecirc;me weekend : Objectif atteint. </span></p>\r\n<p><span class="Apple">Pour leur premier tournoi, les Bisontins ont su motiver de tr&egrave;s bonnes &eacute;quipes, ce fut un r&eacute;el plaisir pour nous de jouer contre des &eacute;quipes de ce niveau . </span></p>\r\n<p><span class="Apple">La journ&eacute;e de samedi a &eacute;t&eacute; tr&egrave;s compliqu&eacute;e pour une tr&egrave;s grande majorit&eacute; des joueurs (les effets de la veille) mais nous n''avons pas &eacute;t&eacute; trop moches non plus... Dimanche, l''arriv&eacute;e de Claire et Banban, nous a fait du bien, mais notre incapacit&eacute; &agrave; produire du beau jeu de mani&egrave;re constante nous a fait mal... Au final, ce fut un beau tournoi, qui je l''esp&egrave;re aura permis de fid&eacute;liser nos petits nouveaux (Hugo, Gilles, Loic et Lulu). Ce fut surement le dernier tournoi de Vlad chez les sesquis, tu vas nous manquer Vlada !!&nbsp;</span></p>\r\n<p>Pour finir merci les Friz''Bisontins et &agrave; l''ann&eacute;e prochaine.&nbsp;</p>', '2011-07-11', 241, 241),
(41, 'Südsee Cup 2011 - 9-10 Juillet - Constance - All.', '<p><span style="text-decoration: underline;"><strong>L''&eacute;quipe :</strong></span></p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="http://a6.sphotos.ak.fbcdn.net/hphotos-ak-snc6/268329_1816280095501_1495075691_31476813_1078520_n.jpg" alt="" width="531" height="376" /></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;"><em>De Gauche &agrave; Droite du Haut en Bas : Saskia, Aur&eacute;lien, Kelly, Taner, St&eacute;phe, Fab, Maurice, Julia, Judith, Ced, Nico</em></span></p>\r\n<p><span style="text-decoration: underline;"><strong>Le Format :&nbsp; </strong></span></p>\r\n<p><strong></strong><span style="font-family: arial,helvetica,sans-serif;">12 &eacute;quipes, 3-4 filles sur la ligne, 40 min, pas de cap.</span></p>\r\n<p><span style="text-decoration: underline;"><strong>Le Spot :&nbsp;</strong></span></p>\r\n<p><strong> </strong><span style="font-family: arial,helvetica,sans-serif;">Complexe universitaire de Constance, au bord du lac, complexe sportif pour les douches, pelouse magnifique.</span></p>\r\n<p><span style="text-decoration: underline;"><strong>Les r&eacute;sultats : </strong></span><span style="font-size: xx-small;">(peut &ecirc;tre qq petites erreurs)</span></p>\r\n<p style="text-align: left;"><span style="font-family: verdana,geneva; font-size: small;">Sesquis - Heidees &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; : 5 - 12 &nbsp; (d&eacute;faite logique)&nbsp;</span></p>\r\n<p><span style="font-family: verdana,geneva; font-size: small;">Sesquis - Maultaschen&nbsp;&nbsp; : 5 - 6 &nbsp;&nbsp; (dommage, match tr&egrave;s accroch&eacute;)&nbsp;&nbsp; </span></p>\r\n<p><span style="font-family: verdana,geneva; font-size: small;">Sesquis - Disconnection : 2 - 12 &nbsp; (d&eacute;faite logique sous un soleil &eacute;touffant)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>\r\n<p><span style="font-family: verdana,geneva; font-size: small;">Sesquis - Sudsee Team&nbsp; : 9 - 2 ?&nbsp; (excellente victoire o&ugrave; on aura &eacute;t&eacute; parfait dans tous les domaines)</span></p>\r\n<p><span style="font-family: verdana,geneva; font-size: small;">Sesquis - Fly High Lausanne :&nbsp; 7 - 3 (victoire au panache, grace &agrave; une bonne zone, et un adversaire qui ne voulait pourtant pas lacher le morceau !)</span></p>\r\n<p><span style="font-size: small; font-family: verdana,geneva;"><strong>On finit 4e sur 6 dans notre poule, et on obtient ainsi le droit de jouer les places 5 &agrave; 8.</strong></span></p>\r\n<p><span style="font-size: small; font-family: verdana,geneva;">Sesquis - Flying Saucers Luzern : 5 - 8 (d&eacute;faite apr&egrave;s un match bien accroch&eacute;, mais un adversaire bien plus technique et physique que nous)</span></p>\r\n<p><span style="font-size: small; font-family: verdana,geneva;">Sesquis - Maultaschen : 3 - 12 (le match de trop.....&nbsp; impossible d''&ecirc;tre &agrave; la hauteur pour prendre notre revanche.)</span></p>\r\n<p><span style="text-decoration: underline;"><strong>Stats et classement :</strong></span></p>\r\n<p>Sesquis : 2 victoires, 5 d&eacute;faites, on finit 8e sur 12.<strong></strong></p>\r\n<h4>Ultimate:&nbsp;&nbsp;&nbsp; 1. Solebang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. Outernationals&nbsp;&nbsp;&nbsp;&nbsp; 3. Disconnection&nbsp;&nbsp;&nbsp; 4. Heidees</h4>\r\n<p><span style="text-decoration: underline;"><strong>Bilan :</strong></span></p>\r\n<p><span style="font-family: arial,helvetica,sans-serif;">Tr&egrave;s bon tournoi pour une &eacute;quipe in&eacute;dite, compos&eacute;e de d&eacute;butants et de peu de joueurs ayant souvent fait ce genre de tournois. Nos filles ont &eacute;t&eacute; au niveau et ont su se d&eacute;marquer et d&eacute;fendre comme il fallait. La zone a m&ecirc;me fonctionn&eacute;e sur certains points !! (et a aussi pris l''eau sur d''autres...).</span></p>\r\n<p><span style="font-family: arial,helvetica,sans-serif;">Sympathique visite de la ville (tr&egrave;s jolie d''ailleurs !!), quoique beaucoup de cabinet de psychiatrie... La m&eacute;t&eacute;o aura &eacute;t&eacute; &agrave; la hauteur quand on en avait besoin (il se mettait a pleuvoir pendant les rondes ;))&nbsp; Les baignades dans le lac nous ont fait du bien. Les autres &eacute;quipes &eacute;taient aussi tr&egrave;s sympas et ont &eacute;t&eacute; agr&eacute;ables &agrave; jouer. Tournoi &agrave; refaire&nbsp; !</span></p>', '2011-07-13', 255, 255),
(42, 'Hat Interflug 2011 / Berlin / DE ', '<p style="text-align: justify;">Apr&egrave;s avoir &eacute;t&eacute; l&acirc;ch&eacute; par les Sesqui Ced et Tom, la minorit&eacute; chinoise des Sesqui a d&eacute;coll&eacute; pour l''INTERFLUG HAT de Berlin.<br />&nbsp;<br />Tous deux tomb&eacute;s dans la poule Americas, le plus jeune R&eacute;mi chez les Cotopaxi, le plus con <span class="il">Philippe</span> chez les Popocatepete, les deux frangins ont sensiblement eut des parcours +/- parall&egrave;les...<br />-A savoir une s&eacute;rie de 5 d&eacute;faites pour l''ain&eacute; et une s&eacute;rie de 5 victoires pour le padawan.<br />-Et puis le 6&egrave;me match, ce fut l''inverse&nbsp;: D&eacute;faite pour R&eacute;mi, victoire pour <span class="il">Philippe</span><br />-Mais la Force des Jedis brid&eacute;s a permis de conjurer le sort pour finir tous les 2 sur une victoire.</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/IMG_0110.jpg" alt="" width="413" height="548" /><br />&nbsp;<br />Bilan :<br />L''Interflug c''est 200 joueurs de GROS NIVEAUX, 16 &eacute;quipes, et beaucoup de fun sur des terrains superbes !<br />Dans le duel fratricide entre chinois: victoire du jeune...<br />3&egrave;me place pour les Cotopaxi de R&eacute;mi !<br />13&egrave;me place pour les Popocatepete de votre serviteur...</p>\r\n<div>\r\n<div style="text-align: justify;">Enjoy,</div>\r\n<div style="text-align: justify;"><span class="il">Philippe</span></div>\r\n</div>', '2011-07-28', 243, 243),
(43, 'Savage Seven / 06-07/08/2011 / Karlsruhe / DE ', '', '2011-08-16', 260, 260),
(44, 'Savage Seven / 06-07/08/2011 / Karlsruhe / DE ', '<p><strong>L''&eacute;quipe:&nbsp;</strong></p>\r\n<p><strong><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/seven%20savage.jpg" alt="" width="505" height="318" /></strong></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;">De gauche &agrave; droite, de haut en bas : Ben, Tom, Ouist, Alex (Friz''bisontins), Jimmy (Psyko), Bab (Psyko), Lau.</span><strong><br /></strong></p>\r\n<p><strong>L</strong><strong><span style="font-weight: normal;"><strong>e Format :&nbsp;</strong></span></strong></p>\r\n<p>10 &eacute;quipes, 7 joueurs par &eacute;quipe sans rempla&ccedil;ant, Matchs de 25 minutes + Tournoi de GUTS &nbsp;</p>\r\n<p><strong>Le Spot :&nbsp;</strong></p>\r\n<p>Terrain au milieu de la for&ecirc;t allemande, camping &agrave; 20 m&egrave;tres, belle pelouse</p>\r\n<p><strong>Les R&eacute;sultats :&nbsp;</strong></p>\r\n<p><em>Phase de poule :&nbsp;</em></p>\r\n<p>1<sup>er </sup>match : Sesquis - <strong>Master Mix</strong> (Pick Up Master Allemand) : 4 - 7&nbsp;</p>\r\n<p>2<sup>&egrave;me </sup>match : Sesquis - Karlsruhe Y : 5 - 5&nbsp;</p>\r\n<p>3<sup>&egrave;me </sup>match : Sesquis - <strong>Bad Raps</strong> (Bad Reutigen) : 5 - 6&nbsp;</p>\r\n<p>4<sup>&egrave;me </sup>match : Sesquis - Lady Killers (Pick Up Fribourg) : 5 - 5</p>\r\n<p><em>Poule basse :&nbsp;</em></p>\r\n<p>5<sup>&egrave;me </sup>match : <strong>Sesquis</strong> - Pick Up Karlsruhe : 8 - 1</p>\r\n<p>6<sup>&egrave;me </sup>match : <strong>Sesquis</strong> - Teefseetaucher (Munich) : 7 - 2 &nbsp;</p>\r\n<p><em>Match pour la 7&egrave;me place :&nbsp;</em></p>\r\n<p>7<sup>&egrave;me </sup>match : Sesquis - <strong>Karlsruhe Y</strong> : 4 - 5&nbsp;</p>\r\n<p><strong>Stats et Classement :&nbsp;</strong></p>\r\n<p>7 match / 2 victoires / 2 nuls / 3 d&eacute;faites&nbsp;</p>\r\n<p>1. Master Mix, 2. Usual Suspect (Pick Up suisse) ... 7. Sesquis&nbsp;</p>\r\n<p><strong>Le Spirit Of The Game :</strong></p>\r\n<p>Malheureusement pas de classement du spirit, les &eacute;quipes n''ayant pas rendu les feuilles... dommage on l''aurait s&ucirc;rement gagn&eacute;, on &eacute;tait vraiment tr&egrave;s tr&egrave;s fun... Petit d&eacute;tail important, on a gagn&eacute; la BIER RACE avec une large avance !!!&nbsp;</p>\r\n<p><strong>Bilan :&nbsp;</strong></p>\r\n<p>Merci aux renforts nanc&eacute;ens et bisontins !&nbsp;</p>', '2011-08-16', 260, 260),
(45, 'Maduina / 3-4/09/2011 / Milan (IT)', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/madunina2011_003.jpg" alt="" width="529" height="373" /></p>\r\n<p style="text-align: center;">De gauche &agrave; droite, de haut en bas : Etienne, Alban, Tom, Fab, Noemie (BTR Toulouse), Anne-Laure, Saskia, Claire, Denis, Phil, Taner, Hugo.</p>', '2011-09-21', 223, 223),
(46, 'Fédéral mixte D2 / 01-02/10/2011 / Blois (FR)', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/%C3%A9quipe%20mixte%20Blois%202011.JPG" alt="" width="543" height="364" /></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;">De gauche &agrave; droite, de haut en bas : taner, saskia, nono, niko, g&eacute;, l&eacute;l&eacute;, dudu, alban, l&eacute;a, steph, katarina, p-a, lau., ouist, claire.</span></p>\r\n<p style="text-align: justify;">Pour la premi&egrave;re fois de son histoire, les sesquis inscrivaient une &eacute;quipe mixte au championnat de France et le moins que l''on puisse dire est que ce weekend restera comme un tr&egrave;s bon souvenir.&nbsp;</p>\r\n<p style="text-align: justify;">Les r&eacute;sultats :&nbsp;</p>\r\n<p style="text-align: justify;">Phase<span class="Apple" style="widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; font: x-small %value; white-space: normal; orphans: 2; letter-spacing: normal; color: #000000; word-spacing: 0px;">&nbsp;de poule : <br />Sesquis - frizgo uno : 15 - 3<br />Sesquis - TD : 8 - 13<br />Sesquis - Sun 2 :&nbsp;7 - 11<br /></span></p>\r\n<p style="text-align: justify;"><span class="Apple" style="widows: 2; text-transform: none; background-color: #ffffff; text-indent: 0px; font: x-small %value; white-space: normal; orphans: 2; letter-spacing: normal; color: #000000; word-spacing: 0px;">Premier match du dimanche matin, contre les 2eme de l''autre<br />poule. Si on gagne, nous jouons la demie...<br />Sesquis - Zerogene : 10 - 11<br /><br />Matchs de classement<br />Sesquis - Frizgo Mud : 14 - 4<br /><br />Match pour la 5eme place<br />Sesquis - hot : 13 - 14 </span></p>\r\n<p style="text-align: justify;">Malgr&eacute; un bilan n&eacute;gatif de 4 d&eacute;faites et 2 victoires, il semble qu''une r&eacute;elle envie de jouer ensemble soit n&eacute;e !! Il s''agira de rester dans la m&ecirc;me dynamique pour les comp&eacute;titions Indoor et Open, pour revenir plus fort l''ann&eacute;e prochaine !!</p>\r\n<p style="text-align: justify;">Merci aux Frizgos pour l''orga, et merci aux sesquis pour ce superbe weekend !!</p>', '2011-10-05', 297, 297),
(47, 'Patate Chaude / 08-09/10/2011 / Vesoul (FR) ', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/vesoul%202011.jpg" alt="" width="457" height="530" /></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;">De gauche &agrave; droite de haut en bas&nbsp;: Hugo, C12, Tom, Ben, Emilien, Fab, Lulu, L&eacute;a, Niko.</span></p>\r\n<p>1&egrave;re phase de poule :</p>\r\n<p>- Victoire contre Belfort : 11/8<br />- D&eacute;faite contre "ta gueule vieux cons" (jeunes Friz''Bisontins) : 4/9<br />- Victoire contre Ultimotte : 10/9<br />2&egrave;me de la poule sur 4 &eacute;quipes</p>\r\n<p>matchs de classements :</p>\r\n<p>- Victoire contre Brave Troopers (&eacute;quipe 1 des Utimate Troopers 1) : 8/6</p>\r\n<p>- D&eacute;faite contre Disc''jonct&eacute;s 1 : 9/10<br />2&egrave;me de la poule ---&gt; 5&egrave;me du tournoi sur 12 &eacute;quipes</p>\r\n<p>Fair play :<br />1er Ultimotte<br />2&egrave;me Sesquis, yeaah !!!</p>', '2011-10-12', 299, 299),
(48, 'Fédéral Open N2 Indoor 29-30/10/2011 Nemours (FR)', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/N2%20INDOOR%20NEMOURS_20111030_42.JPG" alt="" width="555" height="368" /></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;">De gauche &agrave; droite, et de haut en bas : Ced, Thib, Ouist, P-A, Fab, Greg, Dudu, G&eacute;, Lau.</span></p>\r\n<p style="text-align: justify;">C''est avec une &eacute;quipe 1 relook&eacute;e que les Sesquidistus se sont d&eacute;plac&eacute;s &agrave; Nemours pour la premi&egrave;re phase de la Nationale 2. Thibaut et Laurent, anciens de l''&eacute;quipe 2 et Dudu et P-A les anciens bisontins, sont venus remplacer certains anciens (bless&eacute;s, en arr&ecirc;t, ...) , et ont ainsi redonner un coup de jeune &agrave; cette belle &eacute;quipe.&nbsp;</p>\r\n<p style="text-align: justify;">L''objectif &eacute;tait de bien figurer dans une poule d''un tr&egrave;s bon niveau, avec des tsunamis (anciens de N1), des Bisontins qui n''arr&ecirc;tent plus de grimper, des Friselis 2, des Mr Friz, et des joueurs du Hot surmotiv&eacute;s.</p>\r\n<p style="text-align: justify;">Malgr&eacute; 3 d&eacute;faites, les Sesquis ont su arracher leur qualification pour jouer la mont&eacute;e en N1, RDV les 18 et 19 pour cr&eacute;er la surprise... les Friz''Bisontins et les Tsunamis, les accompagneront &agrave; Angers pour y affronter les Tourne-Disc (Clemont), les Ziggles (Nice) et les Magic Disc (Angers).</p>\r\n<p style="text-align: justify;">L''ensemble des r&eacute;sultats sur :&nbsp;</p>\r\n<p style="text-align: left;"><span style="font-size: small;"><a style="font-size: xx-small;" title="R&eacute;sultats et Classement" href="http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Division-2" target="_blank">http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Division-2</a></span></p>', '2011-11-30', 304, 304),
(50, 'Fédéral Open DR2 Indoor 19-20/11/2011', '<p style="text-align: center;"><img src="modules/galerie/picture/DR2%20Faulquemont%202011.jpg" alt="" width="534" height="397" /></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;">De gauche &agrave; droite, de haut en bas : Etienne M., Gilles, Etienne B., R&eacute;mi, Baptiste, Lulu, Denis, Emilien, Hugo, Xavier, Lau., Damien, Scoubi, Katarina, Marion, Marianne, L&eacute;a, Anne-Laure, Julien.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;"><em>L''Ultimate dans l''Est va bien ! </em>Les r&eacute;sultats des &eacute;quipes engag&eacute;es dans les phases aller du championnat Indoor le prouvent :&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;">N1 : L''Everest jouera le titre ; N2 : Les Sesquis 1 et les Friz''Bisontins joueront la mont&eacute;e en N1 ; N3 : Les Psyko joueront la mont&eacute;e en N2.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;"><em>L''Ultimate dans l''Est va tr&egrave;s bien !</em> Plus de joueurs, plus de clubs, plus d''&eacute;quipes ... la ffdf a donc d&eacute;cid&eacute; de cr&eacute;er une nouvelle division r&eacute;gionale </span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;"><em>Les Sesquidistus vont tr&egrave;s tr&egrave;s bien ! </em>Le nombre de licenci&eacute;s explose, plus de 50 au mois de novembre ! et la cr&eacute;ation logique d''une 4<sup>&egrave;me</sup> &eacute;quipe Indoor. </span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;">La phase aller de cette nouvelle DR2 a &eacute;t&eacute; organis&eacute;e par les joueurs de la Bourrasque de Faulquemont, les 19 et 20 novembre 2011 et deux &eacute;quipes des sesquis y ont particip&eacute;.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;">Sesquis 3 (Sesquiflashtus) = 4 victoires, 0 d&eacute;faite, 1er/5 </span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;">Sesquis 3bis (Sesquiglissetus) = 2 victoires, 2 d&eacute;faites, 3&egrave;me/5 </span></p>\r\n<p style="text-align: justify;"><span style="font-size: medium;">Let''s go, Sesquis, Let''s go !!</span></p>\r\n<p>R&eacute;sultats et classement :</p>\r\n<p style="text-align: justify;"><a title="R&eacute;sultats et Classement " href="http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Divisions-Regionales-2/Est" target="_blank">http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Divisions-Regionales-2/Est</a></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;"><span style="font-size: x-small;"><br /></span></span></p>', '2011-11-30', 307, 307),
(51, 'Fédéral Open DR1 Indoor 26-27/11/2011 Besançon(FR)', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/DR1%20INDOOR%20BESANCON%202011-2012%20Aller.JPG" alt="" width="549" height="365" /></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;">De gauche &agrave; droite, de haut en bas : Froggy, Claire, Alban, Nono, Tom, L&eacute;l&eacute;, Taner, Niko''.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;"><span style="font-size: small;">Le weekend dernier les Sesquis 2 se sont d&eacute;plac&eacute;s &agrave; Besan&ccedil;on pour participer &agrave; la phase aller du championnat de DR1 Indoor. Objectif de cette nouvelle &eacute;quipe faire mieux que l''ann&eacute;e pass&eacute;e, c''est &agrave; dire une mont&eacute;e en N3. Au vu des r&eacute;sultats on peut &ecirc;tre confiant : 5 matchs, 5 victoires.</span></span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;"><span style="font-size: small;">Mais on retiendra surtout la tr&egrave;s bonne ambiance qui anime cette &eacute;quipe ! Vous &ecirc;tes beaux les Sesquis 2 !!&nbsp;</span></span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;"><span style="font-size: small;">R&eacute;sultats et classement : </span></span></p>\r\n<p style="text-align: justify;"><a href="http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Divisions-Regionales-1/Est">http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Divisions-Regionales-1/Est</a></p>', '2011-11-30', 308, 308),
(52, 'Classement KYM 2011', '<p style="text-align: center;"><img src="modules/galerie/picture/Meryl%20D%C3%A9fence%20de%20Zone.jpg" alt="" width="533" height="356" /></p>\r\n<p style="text-align: center;"><span style="font-size: small; color: #0000ff;"><strong>1. German Master (DE)</strong></span></p>\r\n<p style="text-align: center;">2. Crazy Dogs (Stans/CH)&nbsp;</p>\r\n<p style="text-align: center;">3. Gummis (Karlsruhe/DE)</p>\r\n<p style="text-align: center;">4. Les Kartofelns (Pick Up FR/DE)</p>\r\n<p style="text-align: center;">5. MaGie (Pick Up/DE)</p>\r\n<p style="text-align: center;">6. Disconnection (Freiburg/DE)</p>\r\n<p style="text-align: center;">7. Friz''bisontins (Besan&ccedil;on/FR)</p>\r\n<p style="text-align: center;">8. Jean Ferrat (Sesquidistus/FR)</p>\r\n<p style="text-align: center;">9. Georges Brassens (Sesquidistus/FR)</p>\r\n<p style="text-align: center;">10. Ulmtimate (Ulm/DE)</p>\r\n<p style="text-align: center;">11. Les Brel (Pick Up/FR)</p>\r\n<p style="text-align: center;">12. Ultimetz (Metz/FR)</p>\r\n<p style="text-align: center;">13. Les A&eacute;rodisques Orbitaux (Strasbourg/FR)</p>\r\n<hr style="width: 500px;" />\r\n<p style="text-align: center;">Spirit Of The Game&nbsp;</p>\r\n<p style="text-align: center;"><span style="font-size: small; color: #0000ff;"><strong>Friz''bisontins (Besan&ccedil;on/FR)&nbsp;</strong></span></p>\r\n<p style="text-align: justify;"><span style="font-size: small; color: #0000ff;"><strong><img src="modules/galerie/picture/Allemand%202%20Mustache.jpg" alt="" width="127" height="85" /><img src="modules/galerie/picture/Thibaut%20Mustache.jpg" alt="" width="129" height="85" /><img src="modules/galerie/picture/Allemand%20Mustache.jpg" alt="" width="124" height="85" /><img src="modules/galerie/picture/Gilles%20Mustache.jpg" alt="" width="142" height="85" /><br /></strong></span></p>', '2011-12-10', 201, 201),
(53, 'Sheep ihn Rein ! / 17-18/12/2011 / Beckum (DE) ', '', '2011-12-21', 309, 114),
(54, 'Sheep ihn Rein ! / 17-18/12/2011 / Beckum (DE) ', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/Photo%20Beckum.jpg" alt="" width="555" height="415" /></p>\r\n<p style="text-align: center;">De gauche &agrave; droite, et de haut en bas : Taner, Emilien, Saskia, Julia, Etienne M., Judith (Psyko), Fab, Roli.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<div><span style="font-size: small;">Pour ce dernier tournoi de l''ann&eacute;e 2011, le challenge &eacute;tait de taille. Au programme, 12 matchs de 22 minutes r&eacute;partis sur 3 phases. 5 pour une premi&egrave;re poule, 5 dans la 2e poule et 2 matchs de classement. Une r&egrave;gle fun &agrave; signaler, apr&egrave;s le coup de sifflet final, le dernier point doit &ecirc;tre marqu&eacute; en 3 passes maximum. Dans les matchs de classement, la r&egrave;gle du cap+1 &eacute;tait appliqu&eacute;e.</span></div>\r\n<div><span style="font-size: small;">18 &eacute;quipes au total dont beaucoup d''&eacute;quipes du coin, notamment, 6 &eacute;quipes de Beckum et sp&eacute;cialement 2 &eacute;quipes de tr&egrave;s jeunes (entre 10 et 14 ans). Ca nous a fait bizzare de jouer contre eux mais leur envie de jouer est remarquable. Ils ont aucun complexes du haut de leur 1,40m ! Les allemands ont 10 ans d''avance sur nous question Ultimate, ce n''est plus &agrave; prouver.</span></div>\r\n<div><span style="font-size: small;">En ce qui concerne notre &eacute;quipe de joyeux lurons, on a disput&eacute; pas mal de matchs accroch&eacute;s. Le niveau &eacute;tait assez homog&egrave;ne. Mais notre manque d''exp&eacute;rience g&eacute;n&eacute;rale et notre petit effectif ne nous a pas permis de rejoindre le milieu du classement. Tom, tu nous a manqu&eacute; !&nbsp;</span></div>\r\n<div><span style="font-size: small;">Au final, 4 victoires, 7 d&eacute;faites, 1 nul. on arrive &agrave; la 14e place sur 18 &eacute;quipes.</span></div>\r\n<div><span style="font-size: small;">Le r&eacute;sultat est un peu frustrant mais on a jamais &eacute;t&eacute; largu&eacute; au score (&agrave; part sur le dernier o&ugrave; le physique n''y &eacute;tait vraiment plus). &nbsp;</span></div>\r\n<div><span style="font-size: small;">Ce qui est important c''est qu''on a tous beaucoup appris et qu''on a quand m&ecirc;me su cr&eacute;er du beau jeu d&egrave;s le 3e match du samedi (les 2 premiers ont servi de r&eacute;glage, vu qu''on &eacute;tait une quasi &eacute;quipe pick-up). Les middles habituels ont du &eacute;galement assurer le Handling: Etienne, Emilien, Saskia, Roli et Judith s''y sont coll&eacute;. Ils sont au taquet maintenant et sont mis sur les rails de la polyvalence !</span></div>\r\n<div><span style="font-size: small;">Et cerise sur le g&acirc;teau, notre combativit&eacute;, nos sourires, et probablement aussi tous les km parcourus ont &eacute;t&eacute; r&eacute;compens&eacute; par le prix du fair-play !</span></div>\r\n<div><span style="font-size: small;">C''est un joli cadeau de No&euml;l et &ccedil;a att&eacute;nue un peu notre d&eacute;ception. Ga&iuml;a va nous envoyer &agrave; chacun un joli disque du Fair-play.</span></div>\r\n<div><span style="font-size: small;">Pour finir, je saluerai la performance de Roli, qui pour son 1er tournoi d''Ultimate nous a montr&eacute; qu''il est un sacr&eacute; renard des surfaces. Nous lui avons donc offert le cadeau du tournoi, un mouton en peluche violet trop mignon qu''on a surnomm&eacute; Becky.&nbsp;</span></div>\r\n<div style="text-align: right;">Fabien</div>', '2011-12-21', 309, 114),
(55, 'Sheep ihn Rein ! / 17-18/12/2011 / Beckum (DE) ', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/Photo%20Beckum.jpg" alt="" width="555" height="415" /></p>\r\n<p style="text-align: center;">De gauche &agrave; droite, et de haut en bas : Taner, Emilien, Saskia, Julia, Etienne M., Judith (Psyko), Fab, Roli.</p>\r\n<p>&nbsp;</p>\r\n<div style="text-align: justify;"><span>Pour ce dernier tournoi de l''ann&eacute;e 2011, le challenge &eacute;tait de taille. Au programme, 12 matchs de 22 minutes r&eacute;partis sur 3 phases. 5 pour une premi&egrave;re poule, 5 dans la 2e poule et 2 matchs de classement. Une r&egrave;gle fun &agrave; signaler, apr&egrave;s le coup de sifflet final, le dernier point doit &ecirc;tre marqu&eacute; en 3 passes maximum. Dans les matchs de classement, la r&egrave;gle du cap+1 &eacute;tait appliqu&eacute;e.</span></div>\r\n<div style="text-align: justify;"><span>18 &eacute;quipes au total dont beaucoup d''&eacute;quipes du coin, notamment, 6 &eacute;quipes de Beckum et sp&eacute;cialement 2 &eacute;quipes de tr&egrave;s jeunes (entre 10 et 14 ans). Ca nous a fait bizzare de jouer contre eux mais leur envie de jouer est remarquable. Ils ont aucun complexes du haut de leur 1,40m ! Les allemands ont 10 ans d''avance sur nous question Ultimate, ce n''est plus &agrave; prouver.</span></div>\r\n<div style="text-align: justify;"><span>En ce qui concerne notre &eacute;quipe de joyeux lurons, on a disput&eacute; pas mal de matchs accroch&eacute;s. Le niveau &eacute;tait assez homog&egrave;ne. Mais notre manque d''exp&eacute;rience g&eacute;n&eacute;rale et notre petit effectif ne nous a pas permis de rejoindre le milieu du classement. Tom, tu nous a manqu&eacute; !&nbsp;</span></div>\r\n<div style="text-align: justify;"><span>Au final, 4 victoires, 7 d&eacute;faites, 1 nul. on arrive &agrave; la 14e place sur 18 &eacute;quipes.</span></div>\r\n<div style="text-align: justify;"><span>Le r&eacute;sultat est un peu frustrant mais on a jamais &eacute;t&eacute; largu&eacute; au score (&agrave; part sur le dernier o&ugrave; le physique n''y &eacute;tait vraiment plus). &nbsp;</span></div>\r\n<div style="text-align: justify;"><span>Ce qui est important c''est qu''on a tous beaucoup appris et qu''on a quand m&ecirc;me su cr&eacute;er du beau jeu d&egrave;s le 3e match du samedi (les 2 premiers ont servi de r&eacute;glage, vu qu''on &eacute;tait une quasi &eacute;quipe pick-up). Les middles habituels ont du &eacute;galement assurer le Handling: Etienne, Emilien, Saskia, Roli et Judith s''y sont coll&eacute;. Ils sont au taquet maintenant et sont mis sur les rails de la polyvalence !</span></div>\r\n<div style="text-align: justify;"><span>Et cerise sur le g&acirc;teau, notre combativit&eacute;, nos sourires, et probablement aussi tous les km parcourus ont &eacute;t&eacute; r&eacute;compens&eacute; par le prix du fair-play !</span></div>\r\n<div style="text-align: justify;"><span>C''est un joli cadeau de No&euml;l et &ccedil;a att&eacute;nue un peu notre d&eacute;ception. Ga&iuml;a va nous envoyer &agrave; chacun un joli disque du Fair-play.</span></div>\r\n<div style="text-align: justify;"><span>Pour finir, je saluerai la performance de Roli, qui pour son 1er tournoi d''Ultimate nous a montr&eacute; qu''il est un sacr&eacute; renard des surfaces. Nous lui avons donc offert le cadeau du tournoi, un mouton en peluche violet trop mignon qu''on a surnomm&eacute; Becky.&nbsp;</span></div>\r\n<div style="text-align: justify;"><span style="white-space: pre;"> </span>Fabien</div>', '2011-12-21', 340, 114),
(56, 'Coupe de l''est INDOOR / 4-5 février 2012', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/affiche%20coupe%20de%20l%5C%27est-1.png" alt="" width="500" height="707" /></p>', '2012-01-04', 310, 114);
INSERT INTO `article` (`id`, `titre`, `contenu`, `date_article`, `id_event`, `id_member`) VALUES
(57, 'Prague Winter / 28-29/01/2012 / Prague (CZ) ', '<p style="text-align: justify;"><strong><span style="font-size: x-small;">Le tournoi :&nbsp;</span></strong></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Pour faire simple, de l''outdoor en indoor. Les matchs se d&eacute;roulent sur un terrain en synth&eacute;tique envelopp&eacute; d''une bulle... des sensations d''Outdoor sur des terrains &agrave; peine plus grand que ceux d''Indoor, bref le kiffe ! C&ocirc;t&eacute; histoire, le terrain est implant&eacute; dans un stade gigantesque (9 terrains de football) dans lequel se tenaient les grandes repr&eacute;sentations militaires... Sur google map s''est tr&egrave;s impr&eacute;ssionnant :<a href="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=cs&amp;msa=0&amp;msid=100981424095373030452.000495db380c6bd7db2c5&amp;t=h&amp;z=18" target="_blank">vue a&eacute;rienne</a>&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;"><a href="http://maps.google.fr/maps?hl=fr&amp;gs_sm=e&amp;gs_upl=1144l7618l0l7969l20l15l4l1l1l2l1328l5241l0.1.2.0.2.3.1.1l15l0&amp;bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&amp;biw=1280&amp;bih=666&amp;q=prague+maps&amp;um=1&amp;ie=UTF-8&amp;hq=&amp;hnear=0x470b939c0970798b:0x400af0f66164090,Prague,+R%C3%A9publique+Tch%C3%A8que&amp;gl=fr&amp;ei=tiYyT-HlBsyEhQeXwKGFBQ&amp;sa=X&amp;oi=geocode_result&amp;ct=image&amp;resnum=1&amp;ved=0CDYQ8gEwAA" target="_blank"></a><strong>Le format :</strong></span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Un tournoi Open (16 &eacute;quipes) &amp; un tournoi Women (8 &eacute;quipes) &nbsp;/ 8 matchs pour toutes les &eacute;quipes.&nbsp;</span></p>\r\n<p style="text-align: justify;"><strong><span style="font-size: x-small;">Les r&eacute;sultats : </span></strong></p>\r\n<p style="text-align: center;"><span style="font-size: medium;"><strong><span style="color: #3366ff;">Sesqueldistut&nbsp;</span></strong></span></p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/Claire%20Puc.jpg" alt="" width="400" height="266" /></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Pour la premi&egrave;re fois de son histoire notre club a pu inscrire une &eacute;quipe 100% f&eacute;minine, son nom SESQUELDISTUT ! Nos filles ont pu se mesurer &agrave; ce qui se fait de mieux dans l''Est, verdict la derni&egrave;re place au classement mais surtout de nombreuses belles actions, des matchs accroch&eacute;s contre le PUC et un tr&egrave;s bel esprit d''&eacute;quipe. Vous &eacute;tiez toutes tr&egrave;s fortes les filles, et tout le monde esp&egrave;re que ce n''est que le d&eacute;but de l''histoire !</span></p>\r\n<p style="text-align: center;"><span style="color: #3366ff; font-size: medium;"><strong>Sesquidistus&nbsp;</strong></span></p>\r\n<p><span style="color: #3366ff;"><strong><span style="font-size: small;"><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/Ouist%20Terrible%20Mokey.jpg" alt="" width="400" height="267" /><br /></span></strong></span></p>\r\n<p style="text-align: justify;"><span style="color: #000000; font-size: x-small;">Compos&eacute;e de joueurs de l''&eacute;quipe 1 et de l''&eacute;quipe 2 plus Julien Prinet, cette &eacute;quipe a r&eacute;alis&eacute; des performances honorables. Il y avait peut &ecirc;tre m&ecirc;me la place pour gagner quelques rangs au classement g&eacute;n&eacute;ral. L''&eacute;quipe termine &agrave; la 12<sup>&egrave;me </sup>place, mais l''essentiel n''est pas l&agrave;... Les sesquis ont produit &agrave; certains moments un jeu simple et efficace... Le capitaine des Girlz Stay Home (Pologne / 5<sup>&egrave;me</sup>) nous a m&ecirc;me dit pendant la ronde, que notre jeu rythm&eacute; fait de scoobers et de push pass &eacute;tait tr&egrave;s "cool"... et &ccedil;a c''est la classe !!&nbsp;</span></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><span style="color: #000000; font-size: x-small;">Les photos du tounroi sont disponibles :<a href="https://plus.google.com/photos/114845861052905956990/albums/5703491671114129473?banner=pwa" target="_blank"> Prague Winter&nbsp;</a></span></p>', '2012-02-08', 320, 114),
(58, 'Coupe de l''Est INDOOR / Strasbourg / 4-5/02/2012', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash4/422788_265328833542063_265227373552209_620464_1686831261_n.jpg" alt="" width="550" height="334" /></p>\r\n<p style="text-align: center;"><em><span style="font-size: xx-small;">Equipe 1 / Equipe 2&nbsp;du jour</span></em></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Relanc&eacute;e en 2010 &agrave; Strasbourg, la coupe de l&rsquo;Est est devenue un r&eacute;el rendez-vous pour tous les joueurs d&rsquo;Ultimate Frisbee Franc-comtois, Lorrains et Alsaciens. 6 &eacute;quipes &eacute;taient inscrites en 2010, 7 en 2011, et 11, cette ann&eacute;e, la preuve que notre sport se d&eacute;veloppe tr&egrave;s bien.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Comme toujours, les Sesquidistus ont &eacute;t&eacute; heureux d&rsquo;accueillir les &eacute;quipes, et ils esp&egrave;rent que chacun aura pu appr&eacute;cier les superbes infrastructures, les crocs au munster, la playlist et les sourires made in sesquis&hellip;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Un grand merci &agrave; la municipalit&eacute; pour ce superbe gymnase et un grand merci &agrave; tous les non joueurs qui ont parfaitement mis la main &agrave; p&acirc;te&hellip; un tr&egrave;s bon entra&icirc;nement avant une &eacute;dition 2012, du Keep Your Mustache qui s&rsquo;annonce excellente&hellip;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">C&ocirc;t&eacute; r&eacute;sultats : <em>&laquo;&nbsp;L&rsquo;Ultimate Indoor, est un sport qui se joue &agrave; 5 contre 5 sur un terrain de Handball, et &agrave; la fin c&rsquo;est l&rsquo;Everest qui gagne&nbsp;&raquo;.</em></span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Comme les Sesquidistus et les Friz&rsquo;bisontins avant eux, les Psykos n&rsquo;ont pas d&eacute;m&eacute;rit&eacute;, mais n&rsquo;ont rien pu faire face aux joueurs de Pontarlier en finale. Un grand bravo &agrave; eux. Un grand bravo &eacute;galement aux Friz&rsquo;bisontins qui repartent avec le SOTG. Les sesquis 1 se classent 4<sup>&egrave;me</sup>&nbsp;et les sesquis 2 terminent &agrave; une tr&egrave;s belle 7<sup>&egrave;me</sup> place.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;"><a href="http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Coupes-Regionales/Est" target="_blank">Resultats complets : 1. Everest, 2. Psykos, 3. Friz''bisontins...</a></span></p>', '2012-02-29', 310, 114),
(59, 'Fédéral Open N2 Indoor / Angers / 18-19/02/2012', '<p style="text-align: center;"><img style="display: block; margin-left: auto; margin-right: auto;" src="https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash4/432127_10150581793724270_679564269_9143273_1175579844_n.jpg" alt="" width="500" height="375" /><em><span style="font-size: xx-small;">Les Friz''bisontins (Champion de N2)&nbsp;</span></em></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small; text-align: justify;">L''&eacute;quipe 1 s''est d&eacute;plac&eacute;e &agrave; Angers avec une seule id&eacute;e en t&ecirc;te, prouver qu''elle m&eacute;rite sa place en poule haute apr&egrave;s une qualification compliqu&eacute;e lors de la phase aller &agrave; Nemours. Le contrat a &eacute;t&eacute; rempli ! Les sesquis reviennent du Maine-et-Loire, avec un bilan tr&egrave;s positif, 3 victoires et 2 d&eacute;faites, se payant m&ecirc;me le luxe de battre leurs amis Friz''bisontins, l''&eacute;quipe sans aucun doute la plus forte de la N2. Avec un peu plus de chance ou de rigueur, le point average aurait pu leur sourire. Leur place de 4&egrave;me ne leur permet pas de monter en N1. Bravo aux Magic-disc d''Angers et aux Tsunamis de Nemours qui accompagneront les Friz''bisontins en division sup&eacute;rieure.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Tous les r&eacute;sultats de la N2 sur le site de la&nbsp;<a href="http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Division-2" target="_blank">FFDF</a>&nbsp;</span></p>', '2012-03-01', 335, 114),
(60, 'Fédéral Indoor  DR1/DR2 / Vesoul  / 25 -26/02/2012', '<p style="text-align: center;"><img style="display: block; margin-left: auto; margin-right: auto;" src="https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash4/396340_10150634349844708_751994707_8926738_2007795065_n.jpg" alt="" width="500" height="375" /><em><span style="font-size: xx-small;">L''&eacute;quipe 3 (Champions de DR2 et Vainqueurs du SOTG)</span></em></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Les sesquidistus se sont d&eacute;plac&eacute;s en nombre &agrave; Vesoul (30 joueurs) pour tenter de confirmer leurs superbes r&eacute;sultats de la phase aller dans les deux divisions r&eacute;gionales de l''Est.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">L''&eacute;quipe 2 garde son invincibilit&eacute; (10 matchs, 10 victoires), d&eacute;j&agrave; deux saisons qu''elle n''a plus perdu en DR1 et aura le droit de jouer les play-offs &agrave; Blois pour la seconde ann&eacute;e cons&eacute;cutive. Avec comme objectif, une mont&eacute;e en N3 que tout le club attend ...</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">L''&eacute;quipe 3 termine cet exercice 2011-2012 de DR2 sans avoir connue la d&eacute;faite malgr&eacute; deux matchs accroch&eacute;s contre la jeune &eacute;quipe de Free-Vol et jouera en DR1 l''ann&eacute;e prochaine. Et cerise sur le g&acirc;teau, elle d&eacute;croche le SOTG !</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">L''&eacute;quipe 4 n''a pas d&eacute;m&eacute;rit&eacute; lors de cette phase (2 victoires et 2 d&eacute;faites) et pourra sans aucun doute disputer la mont&eacute;e la saison prochaine.&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;">Tous les r&eacute;sultats de la DR1 Est sur le site de la <a href="http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Divisions-Regionales-1/Est" target="_blank">FFDF</a>&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;">Tous les r&eacute;sultats de la DR2 Est sur le site de la <a href="http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Indoor/Divisions-Regionales-2/Est" target="_blank">FFDF</a>&nbsp;</span></p>', '2012-03-14', 336, 114),
(61, 'Yellow Submarine / Plzen (CZ) / 3-4/03/2012', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-snc7/429887_10150685880213265_651433264_9270204_1476144046_n.jpg" alt="" width="500" height="374" /></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;">De gauche &agrave; droite, de haut en bas : Vlad, Mike, Nono, Ouist, Lau., Fannie, Lulu, Bat, Fofo, L&eacute;l&eacute;. (merci &agrave; Tom pour la Photo et pour le reste)</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Celles et ceux qui avaient particip&eacute; &agrave; l''&eacute;dition 2011 du tournoi, n''avaient qu''une seule envie, y retourner. En quelques mots le Yellow Submarine c''est : 24 &eacute;quipes en Indoor, du mixte, 8 matchs dans le week-end, des &eacute;quipes polonaises, tch&egrave;ques, slovaques, autrichiennes, allemandes... un super niveau et superbe bonne ambiance !!&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">C&ocirc;t&eacute; resultats, l''&eacute;quipe engag&eacute;e termine &agrave; la 19&egrave;me place. Elle aurait pu faire nettement mieux mais la formule "non-stop" du samedi lui a fait beaucoup de mal... Bilan : 2 victoires, 1 nul, 4 d&eacute;faites (jamais plus de 2 pts d''&eacute;cart).&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Et enfin comme l''ann&eacute;e derni&egrave;re les sesquidistus repartent avec le SOTG !! merci &agrave; toutes les &eacute;quipes et aux Yellow !!</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Vivement l''&eacute;dition 2012 !!</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Tous les r&eacute;sultats sur la page <a href="http://ffindr.com/fr/event/yellow-submarine-2012" target="_blank">FFINDR</a> du tournoi.</span></p>', '2012-03-14', 358, 114),
(62, 'Play-off Indoor / Blois (FR) / 10-11/03/2012', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-snc7/425351_10150697598043265_651433264_9310376_773658016_n.jpg" alt="" width="500" height="375" /></p>\r\n<p style="text-align: center;"><span style="font-size: xx-small;">De gauche &agrave; droite de haut en bas: Tom, Claire, Nono, Froggy, Alban, Taner, L&eacute;l&eacute;, Niko''.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Le club en a r&ecirc;v&eacute;, ils l''ont fait !! l''&eacute;quipe 2 des sesquidistus jouera la saison prochaine en N3. Elle est all&eacute;e d&eacute;crocher sa qualification &agrave; Blois, face aux meilleures &eacute;quipes r&eacute;gionales de l''ouest, d''&icirc;le de france et de m&eacute;dit&eacute;rann&eacute;e.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Cette &eacute;quipe a fait preuve d''une tr&egrave;s grande force mentale, en renversant des situations tr&egrave;s compliqu&eacute;es voir impossible, ce fut notamment le cas, samedi contre les Tchac 2 : &nbsp;10 - 7 pour leurs adversaires cap &agrave; 12, et victoire 12 - 10 au final !!!&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;">Bilan : 4 victoires et 1 d&eacute;faite ! et une troisi&egrave;me place synonyme de mont&eacute;e !!!</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;"><span style="text-decoration: underline;">Bilan de ce championnat Indoor 2011-2012 </span>:&nbsp;</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;">- Sesquis 1 : 4<sup>&egrave;me</sup> de N2</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;">- Sesquis 2 : 1<sup>er</sup> de DR1, 3<sup>&egrave;me</sup>&nbsp;des Play-Offs, Mont&eacute;e en N3</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;">- Sesquis 3 : 1<sup>er</sup> de DR2, SOTG, Mont&eacute;e en DR1</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;">- Sesquis 4 : 3<sup>&egrave;me </sup>de DR2</span></p>\r\n<p style="text-align: justify;"><span style="font-size: xx-small;">Merci &agrave; tous les joueurs pour leur engagement, des r&eacute;sultats &agrave; confirmer en Outdoor Mixte et Open !!</span></p>', '2012-03-14', 371, 114);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `id` tinyint(4) NOT NULL auto_increment COMMENT 'id de la catégorie',
  `titre` varchar(50) NOT NULL COMMENT 'titre',
  `contenu` text NOT NULL COMMENT 'contenu',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations du module club' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `club`
--

INSERT INTO `club` (`id`, `titre`, `contenu`) VALUES
(1, 'Présentation', '<p style="text-align: justify;"><span style="font-size: small;"><strong>Petite histoire et grandes dates ...</strong></span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;">En 1998, &agrave; l''initiative de Mario Tomasi et d''autres passionn&eacute;s du disque, est cr&eacute;&eacute;e une section d''Ultimate Frisbee au sein du </span><a style="font-size: small;" href="http://sucstrasbourg.com/" target="_blank">SUC (Strasbourg Universit&eacute; Club)</a><span style="font-size: small;">. Cette section prendra le nom de "Sesquidistus" &agrave; prononcer "c''est ce qu''ils disent tous". Elle reste membre du </span><a style="font-size: small;" href="http://sucstrasbourg.com/" target="_blank">SUC</a><span style="font-size: small;"> et est affili&eacute;e &agrave; la F&eacute;d&eacute;ration Flyng Disc France depuis sa cr&eacute;ation.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;">Les grandes dates :</span></p>\r\n<p style="text-align: left;"><span style="font-size: small;">- <strong>1998</strong> : Cr&eacute;ation de la section d''Ultimate Frisbee du SUC, son nom sera "Sesquidistus",</span></p>\r\n<p style="text-align: left;"><span style="font-size: small;">-&nbsp;<strong>2001</strong> : Premi&egrave;re participation au championnat de france FFDF Open Indoor et Outdoor,</span></p>\r\n<p style="text-align: left;"><span style="font-size: small;">- <strong>2005</strong> : Inscription d''une deuxi&egrave;me &eacute;quipe au championnat de france FFDF Open Indoor, <br /></span></p>\r\n<p style="text-align: left;"><span style="font-size: small;">-&nbsp;<strong>2007&nbsp;</strong>: Astroneff le second club d''Ultimate strasbourgeois meurt, plusieurs de ses joueurs rejoignent les sesquidistus, &nbsp; &nbsp; &nbsp; &nbsp;</span></p>\r\n<p style="text-align: left;"><span style="font-size: small;">- <strong>2008</strong> : Organisation du tournoi des 10 ans &agrave; Saverne,&nbsp;</span></p>\r\n<p style="text-align: left;"><span style="font-size: small;">- <strong>2010 </strong>: Inscription d''une troisi&egrave;me &eacute;quipe au championnat de france FFDF Open Indoor,</span></p>\r\n<p style="text-align: left;"><span style="font-size: small;">- <strong>2011</strong> : Premi&egrave;re participation d''une &eacute;quipe au championnat de france FFDF Mixte Outdoor, et d''une quatri&egrave;me &eacute;quipe au championnat de france FFDF Open Indoor.&nbsp;</span></p>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<p style="text-align: left;"><strong><span style="font-size: small;">Les Sesquis aujourd''hui ...<span style="font-size: xx-small;"> (d&eacute;cembre 2011)</span>...</span></strong></p>\r\n<p style="text-align: left;"><span style="font-size: small;">Le club compte pas moins de 50 licenci&eacute;s pour la saison 2011/2012....</span></p>\r\n<p style="text-align: left;"><span style="font-size: small;">Page en construction...</span></p>'),
(2, 'Palmarès', '<p style="text-align: center;"><span style="font-size: large;">Championnat de France FFDF Indoor</span>&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;<img style="border-style: initial; border-color: initial;" src="modules/galerie/picture/ronde%20sesquis%20faulquemont.jpg" alt="" width="450" height="110" /></p>\r\n<table border="0" cellspacing="15" align="center">\r\n<tbody>\r\n<tr align="left">\r\n<td><span style="font-size: small; color: #3366ff;"><strong>Saison&nbsp;</strong></span></td>\r\n<td><span style="font-size: small; color: #3366ff;"><strong>Equipe</strong></span></td>\r\n<td><span style="font-size: small; color: #3366ff;"><strong>Division&nbsp;</strong></span></td>\r\n<td><span style="font-size: small; color: #3366ff;"><strong>Classement&nbsp;</strong></span></td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2001-2002 </em></strong></span></td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #00bfff;" align="center">&nbsp;D2&nbsp;<span> </span></td>\r\n<td>&nbsp;5<sup>&egrave;me</sup>/12</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2002-2003</em></strong></span></td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #00bfff;" align="center">D2</td>\r\n<td>&nbsp;6<sup>&egrave;me</sup>/12</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2003-2004</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #00bfff;" align="center">&nbsp;D2&nbsp;</td>\r\n<td>&nbsp;8<sup>&egrave;me</sup>/12</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2004-2005&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1 &nbsp;</td>\r\n<td style="background-color: #00bfff;" align="center">&nbsp;D2</td>\r\n<td>12<sup>&egrave;me</sup>/12&nbsp;(rel&eacute;gation en D3)</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2005-2006&nbsp;</em></strong></span></td>\r\n<td style="background-color: #fdfdfd;">Sesquis 1<br /></td>\r\n<td style="background-color: #87ceeb; text-align: center;">D3</td>\r\n<td style="background-color: #fcfcfc;">8<sup>&egrave;me</sup>/12</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>&nbsp;</em></strong></span></td>\r\n<td style="background-color: #fdfdfd;">Sesquis 2</td>\r\n<td style="background-color: #b0e0e6; text-align: center;">DR1 Est</td>\r\n<td style="background-color: #fcfcfc;">3<sup>&egrave;me</sup>/5</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2006-2007&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #87ceeb;" align="center">&nbsp;D3&nbsp;</td>\r\n<td>&nbsp;2<sup>&egrave;me</sup>/12<sup>&nbsp;</sup>(mont&eacute;e en D2)</td>\r\n</tr>\r\n<tr>\r\n<td rowspan="2" valign="top"><span style="font-size: small;"><strong><em>2007-2008&nbsp;</em>&nbsp;</strong></span></td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #00bfff;" align="center">&nbsp;D2</td>\r\n<td>&nbsp;2<sup>&egrave;me</sup>/12<sup>&nbsp;</sup>(mont&eacute;e en D1)&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Sesquis 2&nbsp;</td>\r\n<td style="background-color: #b0e0e6;" align="center">&nbsp;DR1 Est&nbsp;</td>\r\n<td>&nbsp;3<sup>&egrave;me&nbsp;</sup>/6</td>\r\n</tr>\r\n<tr>\r\n<td rowspan="2" valign="top"><span style="font-size: small;"><strong><em>2008-2009&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #0000ff;" align="center">&nbsp;D1&nbsp;</td>\r\n<td>&nbsp;12<sup>&egrave;me</sup>/12<sup>&nbsp;</sup>(rel&eacute;gation en D2) &nbsp; &nbsp; &nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Sesquis 2&nbsp;</td>\r\n<td style="background-color: #e0ffff;" align="center">&nbsp;DR2 Est&nbsp;</td>\r\n<td>&nbsp;3<sup>&egrave;me</sup>/6&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td rowspan="2" valign="top"><span style="font-size: small;"><strong><em>2009-2010&nbsp;&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #00bfff;" align="center">&nbsp;D2</td>\r\n<td>&nbsp;5<sup>&egrave;me</sup>/12</td>\r\n</tr>\r\n<tr>\r\n<td>Sesquis 2&nbsp;</td>\r\n<td style="background-color: #b0e0e6;" align="center">&nbsp;DR1 Est&nbsp;</td>\r\n<td>&nbsp;4<sup>&egrave;me</sup>/6</td>\r\n</tr>\r\n<tr>\r\n<td rowspan="3" valign="top">\r\n<p><span style="font-size: small;"><strong><em>2010-2011</em>&nbsp;</strong></span></p>\r\n</td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #00bfff;" align="center">D2&nbsp;</td>\r\n<td>&nbsp;6<sup>&egrave;me</sup>/12</td>\r\n</tr>\r\n<tr>\r\n<td>Sesquis 2&nbsp;</td>\r\n<td style="background-color: #b0e0e6;" align="center">&nbsp;DR1 Est&nbsp;</td>\r\n<td>&nbsp;1<sup>er</sup>/8<sup>&nbsp;</sup>(5<sup>&egrave;me&nbsp;</sup>des Play-off)</td>\r\n</tr>\r\n<tr>\r\n<td>Sesquis 3&nbsp;</td>\r\n<td style="background-color: #b0e0e6;" align="center">&nbsp;DR1 Est&nbsp;</td>\r\n<td>\r\n<p>&nbsp;7<sup>&egrave;me</sup>/8</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td rowspan="4" align="left" valign="top"><em><strong><span style="font-size: small;">2011-2012</span></strong></em></td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #00bfff;" align="center">D2</td>\r\n<td>\r\n<p>4<sup>&egrave;me</sup>/12</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>Sesquis 2</td>\r\n<td style="background-color: #b0e0e6;" align="center">DR1 Est&nbsp;</td>\r\n<td>\r\n<p>1<sup>er</sup>/6</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>Sesquis 3&nbsp;</td>\r\n<td style="background-color: #e0ffff;" align="center">DR2 Est&nbsp;</td>\r\n<td>\r\n<p>1<sup>er</sup>/6 (mont&eacute;e en DR1 Est + SOTG)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>Sesquis 4</td>\r\n<td style="background-color: #e0ffff;" align="center">DR2 Est&nbsp;</td>\r\n<td>\r\n<p>3<sup>&egrave;me</sup>/6</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><span style="font-size: large;">﻿Championnat de France FFDF Outdoor&nbsp;</span></p>\r\n<p style="text-align: center;"><span style="font-size: large;"><img src="modules/galerie/picture/%C3%A9quipe%20mixte%20Blois.JPG" alt="" width="450" height="128" /><br /></span></p>\r\n<table border=" 0" cellspacing="15" align="center">\r\n<tbody>\r\n<tr align="left">\r\n<td><span style="font-size: small; color: #3366ff;"><strong>Saison&nbsp;</strong></span></td>\r\n<td><span style="font-size: small; color: #3366ff;"><strong>Equipe</strong></span></td>\r\n<td><span style="font-size: small; color: #3366ff;"><strong>Division&nbsp;</strong></span></td>\r\n<td><span style="font-size: small; background-color: #ffffff; color: #3366ff;"><strong>Classement&nbsp;</strong></span></td>\r\n</tr>\r\n<tr>\r\n<td><strong><span><em><span style="font-size: small;">2001-2002</span><span> </span></em></span></strong></td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #0000ff;" align="center">&nbsp;D1 Open &nbsp;<span> </span></td>\r\n<td>&nbsp;15<sup>&egrave;me</sup>/15</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2002-2003</em></strong></span></td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #00bfff;" align="center">D2 Open&nbsp;</td>\r\n<td>&nbsp;6<sup>&egrave;me</sup>/8</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2003-2004</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #00bfff;" align="center">D2 Open</td>\r\n<td>&nbsp;8<sup>&egrave;me</sup>/8 (rel. en D3)</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2004-2005&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1 &nbsp;</td>\r\n<td style="background-color: #87ceeb;" align="center">&nbsp;D3 Open&nbsp;</td>\r\n<td>&nbsp;6<sup>&egrave;me</sup>/7&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2005-2006&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #87ceeb;" align="center">&nbsp;D3 Open&nbsp;</td>\r\n<td>&nbsp;9<sup>&egrave;me</sup>/20&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><span style="font-size: small;"><strong><em>2006-2007&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #87ceeb;" align="center">&nbsp;D3 Open&nbsp;</td>\r\n<td>&nbsp;9<sup>&egrave;me</sup>/12<sup>&nbsp;</sup></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><span style="font-size: small;"><strong><em>2007-2008&nbsp;</em>&nbsp;</strong></span></td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #87ceeb;" align="center">&nbsp;D3 Open&nbsp;</td>\r\n<td>&nbsp;12<sup>&egrave;me</sup>/12<sup>&nbsp;</sup>(rel. en DR1)&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><span style="font-size: small;"><strong><em>2008-2009&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #b0e0e6;" align="center">&nbsp;DR N-E-I Open</td>\r\n<td>&nbsp;2<sup>&egrave;me</sup>/11<sup>&nbsp;</sup></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><span style="font-size: small;"><strong><em>2009-2010&nbsp;&nbsp;</em></strong></span></td>\r\n<td>Sesquis 1&nbsp;</td>\r\n<td style="background-color: #b0e0e6;" align="center">&nbsp;DR Est-Med Open</td>\r\n<td>&nbsp;2<sup>&egrave;me</sup>/6</td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><span style="font-size: small;"><strong><em>2010-2011</em>&nbsp;&nbsp;</strong></span></td>\r\n<td>Sesquis 1</td>\r\n<td style="background-color: #87ceeb;" align="center">D3 Est Open&nbsp;</td>\r\n<td>&nbsp;3<sup>&egrave;me</sup>/6</td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><span style="font-size: small;"><strong><em>2011-2012</em></strong></span></td>\r\n<td>Sesquis Mix</td>\r\n<td style="background-color: #00bfff;" align="center">D2 Mixte&nbsp;</td>\r\n<td>&nbsp;4<sup>&egrave;me</sup>/6&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="text-align: center;"><span style="font-size: large;">&nbsp;</span></p>'),
(3, 'L''équipe', ''),
(4, 'S''inscrire', '<p><strong><span style="color: #993300;"><em>Une s&eacute;ance d''essai gratuite quelque soit le moment dans la saison</em></span></strong></p>\r\n<p><span style="text-decoration: underline;">Tarifs pour la saison 2010/11 :</span></p>\r\n<ul style="list-style-type: circle;">\r\n<li>licence JOUEUR <strong>71&euro;</strong></li>\r\n<li>licence LOISIR <strong>46&euro;</strong></li>\r\n<li>licence JEUNE <strong>61&euro;</strong> (n&eacute; avant le 1er oct. 1992)</li>\r\n</ul>\r\n<p>Pr&eacute;voir chaussures de salle pour l''Indoor et chaussures &agrave; crampons moul&eacute;s pour l''Outdoor.</p>'),
(5, 'Lieux d''entraînement', '<p><span style="color: #000000; font-size: x-small;"><span style="color: #993300;">INDOOR</span> de la rentr&eacute;e scolaire de septembre &agrave; la fin mars - <strong>gymnase Louvois "Centre Sportif de l''Esplanade"</strong> (chaussures de salle indispensables)</span></p>\r\n<p style="text-align: left;"><span style="font-size: x-small;"><span style="color: #993300;">OUTDOOR</span> de d&eacute;but avril &agrave; fin ao&ucirc;t - <strong>Stade Universitaire, rue Fritz Kieffer</strong> (chaussures &agrave; crampons non moul&eacute;s pr&eacute;f&eacute;rables)</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style="text-decoration: underline; font-size: x-small;">Responsable de l''entrainement : </span></p>\r\n<p><span style="font-size: x-small;">Les entrainements sont principalement assur&eacute;s par Alban FOULONNEAU, Initiateur F&eacute;d&eacute;ral, ayant fait ses d&eacute;buts, au SUC, a jou&eacute; ensuite avec les R&eacute;volution''Air de Paris, pour enfin revenir en Alsace.</span></p>\r\n<p><span style="font-size: x-small;">Il a &eacute;galement assur&eacute; des vacations au SIUAPS (Service Inter Universitaire des Activit&eacute;s Physiques et Sportives) de Strasbourg.</span></p>'),
(6, 'Nos produits', '<p>Frisbee SESQUIDISTUS 12&euro;</p>\r\n<p>Frisbee enfants 10&euro;</p>'),
(7, 'Pourquoi Sesquidistus ? ', '<p><span style="font-size: small;"><span style="font-size: medium;"><strong>Pourquoi "sesquidistus" ?&nbsp;</strong></span><span style="font-size: x-small;">"Allez, va, sesquidistus ! C''est du latin ? "</span></span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;">M&ecirc;me si les anciens ne semblent pas tous &ecirc;tre d''accord sur l''origine du nom, celui-ci serait une r&eacute;f&eacute;rence directe &agrave; un &eacute;pisode des&nbsp;<em>2 minutes du peuple</em>&nbsp;de Fran&ccedil;ois Perusse. Notre archiviste C12 a retrouv&eacute; ce sketch ----&gt;&nbsp;<a href="http://www.youtube.com/watch?v=Ph8Gj4PRL18&amp;feature=share&amp;fb_source=message" target="_blank">Les 2 minutes du Peuple</a></span><span style="font-size: small;">(Ne faites pas attention aux deux adolescentes qui jouent tr&egrave;s mal et soyez bien attentifs, le nom est cit&eacute; deux fois autour de la 20</span><sup>&egrave;me</sup><span style="font-size: small;">&nbsp;seconde)&nbsp;</span></p>');

-- --------------------------------------------------------

--
-- Structure de la table `dossiers_video`
--

CREATE TABLE IF NOT EXISTS `dossiers_video` (
  `id_dossier` int(11) NOT NULL auto_increment,
  `nom_dossier` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_dossier`),
  UNIQUE KEY `nom_dossier` (`nom_dossier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `dossiers_video`
--

INSERT INTO `dossiers_video` (`id_dossier`, `nom_dossier`) VALUES
(1, 'default'),
(12, 'Diverses'),
(14, 'Highlights'),
(17, 'RÃ¨gles'),
(16, 'Reportages');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL auto_increment,
  `id_membre` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `titre` tinytext NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `duree` int(11) NOT NULL default '1',
  `horaire_debut` tinytext NOT NULL,
  `horaire_fin` tinytext NOT NULL,
  `lieu` text NOT NULL,
  `id_lieu` int(11) NOT NULL,
  `contenu_photo` text NOT NULL,
  `contenu_video` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=401 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`id`, `id_membre`, `type`, `titre`, `description`, `date`, `duree`, `horaire_debut`, `horaire_fin`, `lieu`, `id_lieu`, `contenu_photo`, `contenu_video`) VALUES
(133, 0, 1, 'hebdomadaire INDOOR', '', '2010-11-14', 1, '19h00', '22h00', '', 2, '', ''),
(134, 0, 1, 'hebdomadaire INDOOR', '', '2010-11-21', 1, '19h00', '22h00', '', 2, '', ''),
(135, 0, 1, 'hebdomadaire INDOOR', '', '2010-11-28', 1, '19h00', '22h00', '', 2, '', ''),
(136, 0, 1, 'hebdomadaire INDOOR', '', '2010-12-05', 1, '19h00', '22h00', '', 2, '', ''),
(137, 0, 1, 'hebdomadaire INDOOR', '', '2010-12-12', 1, '19h00', '22h00', '', 2, '', ''),
(138, 0, 1, 'hebdomadaire INDOOR', '', '2010-12-19', 1, '19h00', '22h00', '', 2, '', ''),
(140, 0, 1, 'hebdomadaire INDOOR', '', '2011-01-02', 1, '19h00', '22h00', '', 2, '', ''),
(141, 0, 1, 'hebdomadaire INDOOR', '', '2011-01-09', 1, '19h00', '22h00', '', 2, '', ''),
(142, 0, 1, 'hebdomadaire INDOOR', '', '2011-01-23', 1, '19h00', '22h00', '', 2, '', ''),
(143, 0, 1, 'hebdomadaire INDOOR', '', '2011-01-30', 1, '19h00', '22h00', '', 2, '', ''),
(144, 0, 1, 'hebdomadaire INDOOR', '', '2011-02-06', 1, '19h00', '22h00', '', 2, '', ''),
(145, 0, 1, 'hebdomadaire INDOOR', '', '2011-02-13', 1, '19h00', '22h00', '', 2, '', ''),
(146, 0, 1, 'hebdomadaire INDOOR', '', '2011-02-20', 1, '19h00', '22h00', '', 2, '', ''),
(147, 0, 1, 'hebdomadaire INDOOR', '', '2011-02-27', 1, '19h00', '22h00', '', 2, '', ''),
(148, 0, 1, 'hebdomadaire INDOOR', '', '2011-03-06', 1, '19h00', '22h00', '', 2, '', ''),
(151, 0, 4, 'Tournoi Ultimotte ', '', '2010-11-14', 1, '08h00', '18h00', 'Vesoul (FR)', 0, '', ''),
(154, 0, 3, 'AG de notre section', '', '2010-10-22', 1, '19h30', '00h00', 'Mille Club STRASBOURG', 0, '', ''),
(176, 0, 11, 'DR1 retour', '', '2011-02-26', 1, '14h00', '19h00', 'Faulquemont', 0, '', ''),
(177, 0, 11, 'DR1 retour', '', '2011-02-27', 1, '08h00', '17h00', 'Faulquemont', 0, '', ''),
(178, 0, 11, 'DR1 Aller', '', '2010-11-27', 1, '14h00', '19h30', 'Liverdun', 0, '', ''),
(179, 0, 11, 'DR1 aller', '', '2010-11-28', 1, '08h00', '17h00', 'Liverdun', 0, '', ''),
(180, 0, 11, 'D2 aller', 'Samedi: de 14h00 à 18h\r\nDimanche: de 8h à 17h.', '2010-12-18', 2, '14h00', '18h00', 'Nancy', 0, '', ''),
(182, 0, 11, 'D2 RETOUR', '', '2011-02-19', 1, '14h00', '18h00', '?', 0, '', ''),
(183, 0, 11, 'D2 RETOUR', '', '2011-02-20', 1, '09h00', '17h00', '?', 0, '', ''),
(188, 0, 4, 'Coupe de l''Est', 'Samedi: de 9h a 17h  Dimanche: de 8h a 18h. ', '2011-01-22', 2, '09h00', '17h00', 'Pontarlier (FR)', 0, '', ''),
(201, 0, 5, 'Keep your mustache 2011', '', '2011-06-04', 2, '08h00', '17h00', 'Erstein (FR)', 0, 'http://www.frisbee-strasbourg.net/?categorie=galerie_album&album=keep%20your%20moustache', ''),
(202, 0, 1, 'Entrainement OUTDOOR', '', '2011-04-04', 1, '18h00', '21h00', '', 1, '', ''),
(203, 0, 1, 'Entrainement OUTDOOR', '', '2011-04-11', 1, '18h00', '21h00', '', 1, '', ''),
(204, 0, 1, 'Entrainement OUTDOOR', '', '2011-04-18', 1, '18h00', '21h00', '', 1, '', ''),
(205, 0, 1, 'Entrainement OUTDOOR', '', '2011-04-25', 1, '18h00', '21h00', '', 1, '', ''),
(206, 0, 1, 'Entrainement OUTDOOR', '', '2011-05-02', 1, '18h00', '21h00', '', 1, '', ''),
(207, 0, 1, 'Entrainement OUTDOOR', '', '2011-05-09', 1, '18h30', '21h30', '', 1, '', ''),
(208, 0, 1, 'Entrainement OUTDOOR', '', '2011-05-16', 1, '18h30', '21h30', '', 1, '', ''),
(209, 0, 1, 'Entrainement OUTDOOR', '', '2011-05-23', 1, '18h30', '21h30', '', 1, '', ''),
(210, 0, 1, 'Entrainement OUTDOOR', '', '2011-05-30', 1, '18h30', '21h30', '', 1, '', ''),
(211, 0, 4, 'Missuldisc', 'sur herbe, mixte avec 2 ou 3 filles sur la ligne à chaque point  www.frasbadallac.it', '2011-05-07', 2, '09h00', '18h00', 'Gera Lario (IT)', 0, 'http://www.frisbee-strasbourg.net/modules/galerie/mini/Missuldsic%20LowR%202.jpg', ''),
(213, 0, 11, 'DR PLAY-OFFS', 'disputé contre :\r\nles Freezgo Uno de Blois\r\nLes Disc''Lexiques(région parisienne)\r\nles BTRaves (Toulouse)\r\nLes Rising Sun  (Créteil)\r\nles Tchac 2 (St Nazaire)\r\n\r\n\r\n', '2011-03-12', 2, '08h00', '18h00', 'Blois', 0, '', ''),
(215, 0, 5, 'D3 outdoor  phase 2', '', '2011-04-23', 2, '10h00', '17h00', 'Strasbourg (FR)', 0, '', ''),
(216, 0, 1, 'Entrainement OUTDOOR', '', '2011-03-07', 1, '00h00', '00h00', '', 1, '', ''),
(217, 0, 1, 'Entrainement OUTDOOR', '', '2011-03-14', 1, '00h00', '00h00', '', 1, '', ''),
(218, 0, 1, 'Entrainement OUTDOOR', '', '2011-03-21', 1, '00h00', '00h00', '', 1, '', ''),
(219, 0, 1, 'Entrainement OUTDOOR', '', '2011-03-28', 1, '00h00', '00h00', '', 1, '', ''),
(220, 0, 4, 'Yellow Submarine', '', '2011-03-05', 2, '09h00', '18h00', 'Pilsen (CZ)', 0, '', ''),
(222, 0, 4, 'Urban Free''z Beach ', 'sur sable, à 4 contre 4 ', '2011-07-02', 2, '00h00', '00h00', 'Nancy (FR)', 0, '', 'http://www.youtube.com/watch?feature=player_embedded&v=3Zj7Ybh7GCg'),
(223, 0, 4, 'Madunina', '', '2011-09-03', 2, '00h00', '00h00', 'Milan (IT)', 0, 'http://www.frisbee-strasbourg.net/modules/galerie/picture/madunina2011_003.jpg', ''),
(226, 0, 1, 'Entrainement Outdoor', '', '2011-05-05', 1, '18h30', '21h30', '', 1, '', ''),
(227, 0, 1, 'Entrainement Outdoor', '', '2011-05-12', 1, '18h30', '21h30', '', 1, '', ''),
(228, 0, 1, 'Entrainement Outdoor', '', '2011-05-19', 1, '18h30', '21h30', '', 1, '', ''),
(229, 0, 1, 'Entrainement Outdoor', '', '2011-05-26', 1, '18h30', '21h30', '', 1, '', ''),
(230, 0, 1, 'Entrainement Outdoor', '', '2011-06-02', 1, '18h30', '21h30', '', 1, '', ''),
(231, 0, 1, 'Entrainement Outdoor', '', '2011-06-09', 1, '18h30', '21h30', '', 1, '', ''),
(232, 0, 1, 'Entrainement Outdoor', '', '2011-06-16', 1, '18h30', '21h30', '', 1, '', ''),
(233, 0, 1, 'Entrainement Outdoor', '', '2011-06-23', 1, '18h30', '21h30', '', 1, '', ''),
(234, 0, 1, 'Entrainement Outdoor', '', '2011-06-30', 1, '18h30', '21h30', '', 1, '', ''),
(236, 0, 1, 'Entrainement Outdoor', '', '2011-06-06', 1, '18h30', '21h30', '', 1, '', ''),
(237, 0, 1, 'Entrainement Outdoor', '', '2011-06-13', 1, '18h30', '21h30', '', 1, '', ''),
(238, 0, 1, 'Entrainement Outdoor', '', '2011-06-20', 1, '18h30', '21h30', '', 1, '', ''),
(239, 0, 1, 'Entrainement Outdoor', '', '2011-06-27', 1, '18h30', '21h30', '', 1, '', ''),
(241, 0, 4, 'Jurassic Pack', 'Tournoi des Bizontins', '2011-07-09', 2, '00h00', '00h00', 'Saint-Aubin (FR)', 0, 'http://www.frisbee-strasbourg.net/modules/galerie/picture/IMG_5160.JPG', ''),
(243, 0, 4, 'Interflug (HAT) ', '', '2011-07-23', 2, '00h00', '00h00', 'Berlin (DE)', 0, ' http://www.frisbee-strasbourg.net/modules/galerie/picture/IMG_0110.jpg', ''),
(244, 0, 2, 'Championnat d''Europe', 'http://www.euc2011.com/', '2011-07-30', 7, '00h00', '00h00', 'Maribor - Slovenie', 0, '', ''),
(245, 0, 4, 'Windmill Windup ', '', '2011-06-18', 2, '00h00', '00h00', 'Amsterdam (NL)', 0, '', ''),
(246, 0, 1, 'Entrainement', 'Ramenez des grillades et autres boissons, on fera un BBQ après avoir tout donné sur le terrain !', '2011-07-06', 1, '18h30', '21h00', 'Stade de l''Il Boulevard de Dresde', 0, '', ''),
(247, 0, 1, 'Entrainement', '', '2011-07-13', 1, '18h30', '21h00', 'Stade de l''Il Boulevard de Dresde', 0, '', ''),
(248, 0, 1, 'Entrainement', '', '2011-07-20', 1, '18h30', '21h00', 'Stade de l''Il Boulevard de Dresde', 0, '', ''),
(249, 0, 1, 'Entrainement', '', '2011-07-27', 1, '18h30', '21h00', 'Stade de l''Il Boulevard de Dresde', 0, '', ''),
(250, 0, 1, 'C''est l''été mais on se motive !', '', '2011-08-03', 1, '18h30', '21h00', 'Jardin des 2 rives ', 0, '', ''),
(251, 0, 1, 'C''est l''été mais on se motive !', '', '2011-08-10', 1, '18h30', '21h00', 'Stade de l''Il Boulevard de Dresde', 0, '', ''),
(252, 0, 1, 'Entrainement Outdoor ', '', '2011-08-17', 1, '18h30', '21h00', 'Stade de l''Ill Boulevard de Dresde', 0, '', ''),
(255, 0, 4, 'Sudsee Cup ', '', '2011-07-09', 2, '00h00', '00h00', 'Constance (DE)', 0, 'http://a6.sphotos.ak.fbcdn.net/hphotos-ak-snc6/268329_1816280095501_1495075691_31476813_1078520_n.jpg', ''),
(260, 0, 4, 'Savage Seven ', '', '2011-08-06', 2, '00h00', '00h00', 'Karlsruhe (DE) ', 0, 'http://www.frisbee-strasbourg.net/modules/galerie/picture/seven%20savage.jpg', ''),
(261, 0, 4, 'Devil''s Heaven ', '', '2011-02-19', 2, '00h00', '00h00', 'Enschede (NL)', 0, '', ''),
(262, 0, 4, 'MischMasch 22. (HAT)', '', '2011-09-03', 2, '00h00', '00h00', 'Fribourg (DE)', 0, '', ''),
(263, 0, 4, 'Force Lake (HAT)', 'Ced, Phil, Lau., Tom ', '2011-04-30', 2, '00h00', '00h00', 'Lausanne (CH)', 0, '', ''),
(264, 0, 4, 'Flying Dahu (HAT)', 'Fab, lélé, Lau.', '2011-01-15', 2, '00h00', '00h00', 'Morgins (CH)', 0, '', ''),
(265, 0, 11, 'Champ. Indoor Aller DR Est ', '', '2010-11-27', 2, '00h00', '00h00', 'Liverdun (FR)', 0, '', ''),
(266, 0, 1, 'Entrainement Outdoor ', '', '2011-08-22', 1, '18h30', '21h00', '', 1, '', ''),
(267, 0, 1, 'Entrainement Outdoor ', '', '2011-08-29', 1, '18h30', '21h00', '', 1, '', ''),
(268, 0, 1, 'Entrainement Outdoor ', '', '2011-09-05', 1, '18h30', '21h00', '', 1, '', ''),
(269, 0, 1, 'Entrainement Outdoor ', '', '2011-09-12', 1, '18h30', '21h00', '', 1, '', ''),
(270, 0, 1, 'Entrainement Outdoor ', '', '2011-09-19', 1, '18h30', '21h00', '', 1, '', ''),
(271, 0, 1, 'Entrainement Outdoor ', '', '2011-09-26', 1, '18h30', '21h00', '', 1, '', ''),
(272, 0, 1, 'Entrainement Indoor', '', '2011-09-11', 1, '19h00', '22h00', '', 2, '', ''),
(273, 0, 1, 'Entrainement Indoor', '', '2011-09-18', 1, '19h00', '22h00', '', 2, '', ''),
(274, 0, 1, 'Entrainement Indoor', '', '2011-09-25', 1, '19h00', '22h00', '', 2, '', ''),
(275, 0, 1, 'Entrainement Indoor', '', '2011-10-02', 1, '19h00', '22h00', '', 2, '', ''),
(276, 0, 1, 'Entrainement Indoor', '', '2011-10-09', 1, '19h00', '22h00', '', 2, '', ''),
(277, 0, 1, 'Entrainement Indoor', '', '2011-10-16', 1, '19h00', '22h00', '', 2, '', ''),
(278, 0, 1, 'Entrainement Indoor', '', '2011-10-23', 1, '19h00', '22h00', '', 2, '', ''),
(279, 0, 1, 'Entrainement Indoor', '', '2011-10-30', 1, '19h00', '22h00', '', 2, '', ''),
(280, 0, 1, 'Entrainement Indoor', '', '2011-11-06', 1, '19h00', '22h00', '', 2, '', ''),
(281, 0, 1, 'Entrainement Indoor', '', '2011-11-13', 1, '19h00', '22h00', '', 2, '', ''),
(282, 0, 1, 'Entrainement Indoor', '', '2011-11-20', 1, '19h00', '22h00', '', 2, '', ''),
(283, 0, 1, 'Entrainement Indoor', '', '2011-11-27', 1, '19h00', '22h00', '', 2, '', ''),
(284, 0, 1, 'Entrainement Indoor', 'Entraînement pour tous les licenciés ! Début de l''entraînement à 19h pétante !', '2011-12-04', 1, '19h00', '22h00', '', 2, '', ''),
(285, 0, 1, 'Entrainement Indoor', 'Entraînement pour tous les licenciés ! Début de l''entraînement à 19h pétante !', '2011-12-11', 1, '19h00', '22h00', '', 2, '', ''),
(286, 0, 1, 'Entrainement Indoor', 'Entraînement pour tous les licenciés ! Début de l''entraînement à 19h pétante !', '2011-12-18', 1, '19h00', '22h00', '', 2, '', ''),
(288, 0, 4, '3rd Frontier Runners (HAT)', '', '2011-08-20', 2, '00h00', '00h00', 'Saarbrück (DE)', 0, '', ''),
(289, 0, 1, 'Entraînement Physique ', 'Apporter vos crampons, running, chrono... ', '2011-09-21', 1, '18h45', '00h00', '', 1, '', ''),
(290, 0, 1, 'Entraînement Physique ', 'Apporter vos crampons, running, chrono... ', '2011-09-14', 1, '18h45', '00h00', '', 1, '', ''),
(291, 0, 1, 'Entraînement Physique ', 'Apporter vos crampons, running, chrono... ', '2011-09-07', 1, '18h45', '20h00', '', 1, '', ''),
(292, 0, 1, 'Entraînement Physique ', 'Apporter vos crampons, running, chrono... ', '2011-09-28', 1, '18h45', '00h00', '', 1, '', ''),
(293, 0, 1, 'Entraînement Physique ', 'Apporter vos crampons, running, chrono... ', '2011-10-05', 1, '18h45', '00h00', '', 1, '', ''),
(294, 0, 1, 'Entraînement Physique ', 'Apporter vos crampons, running, chrono... ', '2011-10-12', 1, '18h45', '00h00', '', 1, '', ''),
(295, 0, 1, 'Entraînement Physique ', 'Apporter vos crampons, running, chrono... ', '2011-10-19', 1, '18h45', '00h00', '', 1, '', ''),
(296, 0, 1, 'Entraînement Physique ', 'Apporter vos crampons, running, chrono... ', '2011-10-26', 1, '18h45', '00h00', '', 1, '', ''),
(297, 0, 4, 'Mixte D2 Outdoor ', '', '2011-10-01', 2, '09h00', '17h00', 'Blois (FR)', 0, '', ''),
(299, 0, 4, 'Tournoi de la Patate Chaude', '', '2011-10-09', 1, '09h00', '17h00', 'Vesoul (FR)', 0, '', ''),
(304, 0, 4, 'Open N2 Indoor Aller', '', '2011-10-29', 2, '00h00', '00h00', 'Nemours (FR)', 0, 'http://www.frisbee-strasbourg.net/modules/galerie/picture/N2%20INDOOR%20NEMOURS_20111030_42.JPG', ''),
(305, 0, 1, 'Cross Fit ', '', '2011-11-30', 1, '18h45', '19h45', '', 1, '', ''),
(306, 0, 1, 'Cross Fit ', '', '2011-11-23', 1, '18h45', '19h45', '', 1, '', ''),
(307, 0, 4, 'Open DR2 Indoor Aller', '', '2011-11-19', 2, '00h00', '00h00', 'Faulquemont (FR)', 0, 'http://www.frisbee-strasbourg.net/modules/galerie/picture/DR2%20Faulquemont%202011.jpg', ''),
(308, 0, 4, 'Open DR1 Indoor Aller', '', '2011-11-26', 2, '00h00', '00h00', 'Besançon (FR)', 0, 'http://www.frisbee-strasbourg.net/modules/galerie/picture/DR1%20INDOOR%20BESANCON%202011-2012%20Aller.JPG', ''),
(310, 0, 5, 'Coupe de l''Est Indoor ', '', '2012-02-04', 2, '00h00', '00h00', 'Strasbourg (Gymnase Reuss) ', 0, '', ''),
(311, 0, 1, 'Entraînement Indoor ', 'Entraînement pour tous les licenciés ! Début de l''entraînement à 19h pétante !', '2012-01-08', 1, '19h00', '22h00', '', 2, '', ''),
(312, 0, 1, 'Entraînement Indoor ', 'Entraînement pour tous les licenciés ! Début de l''entraînement à 19h pétante !', '2012-01-15', 1, '00h00', '00h00', '', 2, '', ''),
(313, 0, 1, 'Entraînement Indoor ', 'Entraînement pour tous les licenciés jusqu''à 20h30.  Pour les équipes 1 et 2, de 20h30 à 22h.', '2012-01-22', 1, '19h00', '22h00', '', 2, '', ''),
(314, 0, 1, 'Entraînement Indoor ', 'Entraînement pour tous les licenciés.', '2012-01-29', 1, '00h00', '00h00', '', 2, '', ''),
(316, 0, 1, 'Entraînement Indoor ', 'Entraînement pour tous les licenciés jusqu''à 20h30.  Pour les équipes 1 et 2, de 20h30 à 22h.', '2012-02-12', 1, '19h00', '22h00', '', 2, '', ''),
(317, 0, 1, 'Entraînement Indoor ', 'Entraînement pour tous les licenciés jusqu''à 20h30.  Pour les équipes 2, 3 et 4, de 20h30 à 22h.', '2012-02-19', 1, '00h00', '00h00', '', 2, '', ''),
(318, 0, 1, 'Entraînement Indoor ', 'Entraînement pour tous ! Préparation pour la reprise de l''outdoor ', '2012-02-26', 1, '00h00', '00h00', '', 2, '', ''),
(320, 0, 4, 'Prague Winter ', '', '2012-01-28', 2, '00h00', '00h00', 'Praha (CZ) ', 0, '', ''),
(325, 0, 1, 'Cross Fit ', 'De la sueur et du bon son !!', '2012-01-11', 1, '18h45', '19h45', '', 1, '', ''),
(326, 0, 1, 'Cross Fit ', 'De la sueur et du bon son !!', '2012-01-18', 1, '18h45', '19h45', '', 1, '', ''),
(335, 0, 4, 'Open N2 Indoor Retour', '', '2012-02-18', 2, '00h00', '00h00', 'Angers (FR)', 0, '', ''),
(336, 0, 4, 'Open DR1/DR2 Indoor Retour', '', '2012-02-25', 2, '00h00', '00h00', 'Vesoul (FR)', 0, '', ''),
(337, 0, 1, 'Entraînement Physique ', 'N''oubliez pas vos chronomètres et vos  stylos ! ', '2011-12-05', 1, '18h45', '19h45', '', 1, '', ''),
(338, 0, 1, 'Entraînement Physique ', 'N''oubliez pas vos chronomètres et vos  stylos ! ', '2011-12-12', 1, '18h45', '19h45', '', 1, '', ''),
(339, 0, 1, 'Entraînement Physique ', 'N''oubliez pas vos chronomètres et vos  stylos ! ', '2011-12-19', 1, '18h45', '19h45', '', 1, '', ''),
(340, 0, 4, 'Sheep ihn Rein !', '', '2011-12-17', 2, '00h00', '00h00', 'Beckum (DE)', 0, '', ''),
(342, 0, 1, 'Entrainement Outdoor ', '25 participants', '2012-03-12', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(343, 0, 1, 'Entrainement Outdoor ', '25 joueurs présents', '2012-03-19', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(344, 0, 1, 'Entrainement Outdoor ', '', '2012-03-26', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(345, 0, 1, 'Entrainement Outdoor ', '', '2012-04-02', 1, '18h30', '21h00', '', 1, '', ''),
(346, 0, 1, 'Entrainement Outdoor ', '', '2012-04-09', 1, '18h30', '21h00', '', 1, '', ''),
(347, 0, 1, 'Entrainement Outdoor ', '', '2012-04-16', 1, '18h30', '21h00', '', 1, '', ''),
(348, 0, 1, 'Entrainement Outdoor ', '', '2012-04-23', 1, '18h30', '21h00', '', 1, '', ''),
(349, 0, 1, 'Entrainement Outdoor ', '', '2012-04-30', 1, '18h30', '21h00', '', 1, '', ''),
(350, 0, 1, 'Entrainement Outdoor ', '', '2012-05-07', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(351, 0, 1, 'Entrainement Outdoor ', '', '2012-05-14', 1, '18h30', '21h00', 'Stade d''Ill', 0, '', ''),
(352, 0, 1, 'Entrainement Outdoor ', '', '2012-05-21', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(353, 0, 1, 'Entrainement Outdoor ', '', '2012-05-28', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(354, 0, 1, 'Entrainement Outdoor ', '', '2012-06-04', 1, '18h30', '21h00', '', 1, '', ''),
(355, 0, 1, 'Entrainement Outdoor ', '', '2012-06-11', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(356, 0, 1, 'Entrainement Outdoor ', '', '2012-06-18', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(357, 0, 1, 'Entrainement Outdoor ', '', '2012-06-25', 1, '18h30', '21h00', 'Stade de l''Ill', 0, '', ''),
(358, 0, 4, 'Yellow Submarine', '', '2012-03-03', 2, '08h00', '19h00', 'Pilsen (CZ)', 0, '', ''),
(363, 0, 1, 'Entraînement Outdoor', '', '2012-04-05', 1, '19h00', '21h00', 'Stade de Mundolsheim', 0, '', ''),
(364, 0, 1, 'Entraînement Outdoor', '', '2012-04-12', 1, '19h00', '21h00', 'Stade de Mundolsheim', 0, '', ''),
(365, 0, 1, 'Entraînement Outdoor', '', '2012-04-19', 1, '19h00', '21h00', 'Stade de Mundolsheim', 0, '', ''),
(366, 0, 1, 'Entraînement Outdoor', '', '2012-04-26', 1, '19h00', '21h00', 'Stade de Mundolsheim', 0, '', ''),
(367, 0, 1, 'Entraînement Outdoor', '22 participants', '2012-03-08', 1, '00h00', '00h00', 'Stade de Mundolsheim', 0, '', ''),
(368, 0, 1, 'Entraînement Outdoor', '17 participants', '2012-03-15', 1, '19h00', '21h00', 'Stade de Mundolsheim', 0, '', ''),
(369, 0, 1, 'Entraînement Outdoor', '15 joueurs présents', '2012-03-22', 1, '19h00', '21h15', 'Stade de Mundolsheim', 0, '', ''),
(370, 0, 1, 'Entraînement Outdoor', '', '2012-03-29', 1, '19h00', '21h00', 'Stade de Mundolsheim', 0, '', ''),
(371, 0, 4, 'Play-off FFDF Open Indoor ', '', '2012-03-10', 2, '00h00', '00h00', 'Blois (FR)', 0, '', ''),
(372, 0, 4, 'Championnat FFDF Open Outdoor', '', '2012-03-31', 2, '00h00', '00h00', 'Besançon (FR)', 0, '', ''),
(373, 0, 4, 'Championnat FFDF Open Outdoor ', '', '2012-04-28', 2, '00h00', '00h00', 'Besançon ', 0, '', ''),
(374, 0, 1, 'Entrainement Outdoor ', '', '2012-03-24', 1, '10h00', '14h00', 'Mundolsheim', 0, '', ''),
(376, 0, 1, 'Entrainement Outdoor', '', '2012-05-24', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(377, 0, 1, 'Entrainement Outdoor', '', '2012-05-31', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(378, 0, 1, 'Entrainement Outdoor', '', '2012-06-07', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(379, 0, 1, 'Entrainement Outdoor', '', '2012-06-14', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(380, 0, 1, 'Entrainement Outdoor', '', '2012-06-21', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(381, 0, 1, 'Entrainement Outdoor', '', '2012-06-28', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(382, 0, 1, 'Entrainement Outdoor ', '', '2012-05-03', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(383, 0, 1, 'Entrainement Outdoor ', '', '2012-05-10', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(384, 0, 1, 'Entrainement Outdoor ', '', '2012-05-17', 1, '19h00', '22h00', 'Mundolsheim', 0, '', ''),
(385, 0, 5, 'KYM''12', '', '2012-06-02', 1, '08h00', '23h00', 'Erstein', 0, '', ''),
(386, 0, 5, 'KYM''12', '', '2012-06-03', 1, '08h00', '23h00', 'Erstein', 0, '', ''),
(387, 0, 4, 'Urban Free''z Beach Vol 4.', '', '2012-06-24', 1, '08h00', '23h00', 'Pont-à-mousson ', 0, '', ''),
(388, 0, 4, 'Urban Free''z Beach Vol 4.', '', '2012-06-23', 1, '08h00', '23h00', 'Pont-à-mousson ', 0, '', ''),
(389, 0, 4, 'Sudsee Cup 2012', '', '2012-06-30', 1, '00h00', '00h00', 'Konstanz (DE)', 0, '', ''),
(390, 0, 4, 'Sudsee Cup 2012', '', '2012-07-01', 1, '00h00', '00h00', 'Konstanz (DE)', 0, '', ''),
(391, 0, 4, 'Talampaya', '', '2012-05-26', 1, '00h00', '00h00', 'Genève (CH)', 0, '', ''),
(392, 0, 4, 'Talampaya', '', '2012-05-27', 1, '00h00', '00h00', 'Genève (CH)', 0, '', ''),
(394, 0, 1, 'Entrainement Outdoor ', '', '2012-07-02', 1, '18h30', '00h00', 'Stade de l''Ill', 0, '', ''),
(395, 0, 1, 'Entrainement Outdoor ', '', '2012-07-09', 1, '18h30', '00h00', 'Stade de l''Ill', 0, '', ''),
(396, 0, 1, 'Entrainement Outdoor ', '', '2012-07-16', 1, '18h30', '00h00', 'Stade de l''Ill', 0, '', ''),
(397, 0, 4, 'Jurassic Pack ', '', '2012-07-07', 2, '00h00', '00h00', 'Saint Aubin (FR)', 0, '', ''),
(398, 0, 1, 'Entrainement Outdoor ', '', '2012-07-05', 1, '00h00', '00h00', 'Mundolsheim', 0, '', ''),
(399, 0, 1, 'Entrainement Outdoor ', '', '2012-07-12', 1, '00h00', '00h00', 'Mundolsheim', 0, '', ''),
(400, 0, 1, 'Entrainement Outdoor ', '', '2012-07-19', 1, '00h00', '00h00', 'Mundolsheim', 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `forum_cat`
--

CREATE TABLE IF NOT EXISTS `forum_cat` (
  `ID` int(11) NOT NULL auto_increment COMMENT 'identifiant de la catégorie.',
  `LIBELLE` varchar(255) character set latin1 NOT NULL COMMENT 'titre de la catégorie.',
  `RANG` tinyint(4) NOT NULL COMMENT 'position de la liste lors de l''affichage.',
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant les catégories.' AUTO_INCREMENT=35 ;

--
-- Contenu de la table `forum_cat`
--

INSERT INTO `forum_cat` (`ID`, `LIBELLE`, `RANG`) VALUES
(31, 'Participation aux tournois : l\\''avant et l\\''après ', 1),
(32, 'Organisation de nos tournois ', 2),
(33, 'Team building ', 3),
(34, 'L\\''Ultimate ', 4);

-- --------------------------------------------------------

--
-- Structure de la table `forum_msg`
--

CREATE TABLE IF NOT EXISTS `forum_msg` (
  `ID` int(11) NOT NULL auto_increment COMMENT 'identifiant du message',
  `CONTENU` text character set latin1 NOT NULL COMMENT 'Contenu du message.',
  `DATE_PUB` int(11) NOT NULL,
  `ID_TOPIC` int(11) NOT NULL COMMENT 'Id du topic dans lequel le msg est posté.',
  `ID_MEMBRE` int(11) NOT NULL COMMENT 'ID du membre postant.',
  PRIMARY KEY  (`ID`),
  KEY `ID_MEMBRE` (`ID_MEMBRE`),
  KEY `ID_TOPIC` (`ID_TOPIC`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant tous les messages.' AUTO_INCREMENT=235 ;

--
-- Contenu de la table `forum_msg`
--

INSERT INTO `forum_msg` (`ID`, `CONTENU`, `DATE_PUB`, `ID_TOPIC`, `ID_MEMBRE`) VALUES
(9, '<p>Si quelqu\\''un est interess&eacute; pour une sortie &agrave; la neige dans les prochains jours, manifestez-vous ici !!</p>\r\n<p>&nbsp;</p>\r\n<p>Mardi le 03 janv ???&nbsp; qqn ???</p>', 1325155519, 2, 120),
(10, '<p>Nan merci, j\\''aime pas la neige (ou alors j\\''ai pas la dispo, au choix).</p>', 1325156330, 2, 132),
(11, '<p>dans les deux cas t\\''es chiant....&nbsp;&nbsp; :pp</p>', 1325156810, 2, 120),
(14, '<p>J\\''aime vachement ton frangin !</p>', 1325181848, 3, 114),
(16, '<p>OK mais faudrait essayer de lui en trouver une qu\\''il ne connait pas encore !! ;o)</p>', 1325504465, 3, 116),
(17, 'Trop tard :(', 1325526618, 2, 123),
(22, '<p>en soi ton pseudo est une contrepetrie : pepite</p>', 1325628318, 3, 120),
(23, '<p>Quelques petites nouvelles du front...</p>\r\n<p>Le service des sports de la ville d\\''Erstein a re&ccedil;u un retour au courrier que j\\''avais envoy&eacute; au maire pour l\\''orga du tournoi en juin prochain... il a not&eacute; un petit \\"TB, allons-y\\" sur le courrier ce qui est cool surtout que j\\''avais demande plus de choses que l\\''annee derniere et notamment un grand chapiteau pour remplacer nos petits marabous devant la salle Hanfroest ... Chapiteau qui serait installe par les agants de la commune...</p>\r\n<p>Je vais maintenant contacte les responsables du club de football, pour d&eacute;finir la date, a priori &ccedil;a devrait le faire pour le premier weekend de juin.&nbsp;</p>\r\n<p>Je vous tiens au jus, des que j\\''ai toutes les infos on pourra lancer la com...</p>\r\n<p>A plus&nbsp;</p>', 1325666326, 4, 114),
(26, '<p>Quelqu\\''un est motiv&eacute; pour s\\''occuper de &ccedil;a ?&nbsp;</p>', 1325700639, 5, 114),
(27, '<p>\\"&agrave; l\\''&eacute;quope\\", tu r&eacute;pondais en temps et en heure...</p>', 1325867111, 2, 120),
(29, '<p>Si vous voulez voir ce qu\\''est le Disc Golf; rdv cet apr&egrave;s-midi &agrave; 14h au CREPS.Mario et sa bande se font une petite comp&eacute;tition entre eux. &ccedil;a peut-&ecirc;tre sympa d\\''y faire un tour pour regarder.</p>\r\n<p>Ben et moi y serons.</p>', 1325931743, 6, 136),
(31, '<p>On mange o&ugrave; ?</p>', 1326131768, 7, 114),
(32, '<p>dans ton ...</p>', 1326136154, 7, 116),
(33, '<p>treve de plaisanterie ... (j\\''suis contamin&eacute;e &agrave; force !)</p>\r\n<p>tr&eacute;s probablement au Shahi Mahal</p>\r\n<p>&nbsp;</p>', 1326136295, 7, 116),
(34, '<p>dans mon nez ?? .... non il n\\''y aura pas la place ...</p>', 1326227252, 7, 114),
(35, '<p>des crocs au munster, des crocs au munster, des crocs au munster !!</p>', 1326270333, 8, 114),
(36, '<p>Tr&egrave;ve de plaisanteries, nous pourrions d&eacute;j&agrave; commencer &agrave; r&eacute;fl&eacute;chir sur ce que nous allons pouvoir vendre &agrave; la buvette. Pour les &nbsp;nouveaux, nous avions l\\''habitude de proposer des croc-monsieur aux equipes, c\\''est un classique qui marche tres bien... notre specialite, ce sont les crocs au munster ... un reel delice ... Mais iul faut aussi preparer des salades, des gateaux, des cakes ?&nbsp;</p>\r\n<p>Pour le reste, si nous voulons vendre de l\\''alcool, il faut en faire la demande a la commune... Claire, tu t\\''en charges habituellement... pourrais tu faire une demande ?&nbsp;</p>\r\n<p>Qui veut rapporte quoi ? qui a un appareil a croc ? qui peut et veut aller faire les courses le vendredi ?&nbsp;</p>', 1326271132, 8, 114),
(37, '<p>Ok pour les courses, j\\''peux m\\''en occuper...</p>', 1326286939, 8, 131),
(38, '<p>je ne serai pas l&agrave; malheureusement!!</p>', 1326287050, 7, 121),
(41, '<p>just flood this forum ;)</p>', 1326321912, 7, 123),
(42, '<p>Merci Claire pour l\\''orga !! et merci le trou pour l\\''odeur de merde sur tous mes vetements ...</p>', 1326541523, 7, 114),
(44, '+1 c\\''Ã©tait sympa.\r\n\r\nPour l\\''odeur c\\''Ã©tait pas le trou ni ton lave linge......\r\n\r\n:)', 1326552859, 7, 123),
(45, '<p>Je me propose pour tenir la buvette, les matins par exemple.</p>', 1326566117, 8, 143),
(46, '<p>Je n\\''aurais jamais imagin&eacute; finir au trou, comme quoi avec les sesquis tout est possible.</p>', 1326566335, 7, 143),
(48, '<p>Bien re&ccedil;u le message!</p>\r\n<p>Lulu s\\''en occupe, mais si je peux aider, faites-moi savoir, ce sera avec plaisir ;-)))</p>', 1326634178, 5, 142),
(49, '<p>Je peux faire ma fameuse salade aux lentilles comme y\\''a deux ans, &ccedil;a avait pas mal march&eacute; du tout ^^ Je pense que si j\\''en fais 2 ou 3 kg ce sera pas mal :p&nbsp;</p>', 1326742471, 8, 129),
(50, '<p>Pour celles et ceux qui souhaitent partager un verre avec moi le soir de mes 30 ans, nous serons demain mercredi au Mudd Club, 7 rue de l\\''Arc en Ciel (pr&egrave;s de la place St Etienne), &agrave; partir de 21h... Le concert de punk pr&eacute;vu au sous-sol ne devrait pas nous d&eacute;ranger, voir m&ecirc;me permettre &agrave; ceux qui ne vont pas au cross-fit de se d&eacute;fouler un peu !!.. A demain p\\''t\\''&ecirc;tre alors !&nbsp;<img title=\\"Cool\\" src=\\"tinymce/plugins/emotions/img/smiley-cool.gif\\" border=\\"0\\" alt=\\"Cool\\" /></p>', 1326797950, 9, 131),
(51, '<p>Ah oui merde, j\\''avais oubli&eacute; l\\''histoire de la dde pour la vente d\\''alcool ...</p>\r\n<p>j\\''vais le faire !</p>', 1326800527, 8, 116),
(52, '<p>Au choix, crossfit-pogo ou crossfit-slam !&nbsp;</p>\r\n<p>A demain !!</p>', 1326832383, 9, 143),
(53, '<p>Mieux vaut s\\''accrocher aux berges du ravin?</p>\r\n<p>&nbsp;</p>\r\n<p>ou glisser dans la piscine?</p>\r\n<p>&nbsp;</p>\r\n<p>Le linge s&egrave;che dans le vent</p>\r\n<p>&nbsp;</p>\r\n<p>L\\''infirmi&egrave;re indolente, lave mal les gosses</p>', 1326843289, 3, 142),
(54, '<p>Plus dures?</p>\r\n<p>&nbsp;</p>\r\n<p>Accul&eacute;s jusqu\\''&agrave; la tranch&eacute;e, les morts se confondent</p>\r\n<p>&nbsp;</p>\r\n<p>Plus facile:</p>\r\n<p>La Reine veut encore Blair, mais qui va l\\''apaiser?</p>', 1326843501, 3, 142),
(55, '<p>Fabien tu peux te mettre en relation avec Emilien au sujet des courses ? Je pense qu\\''il faudrait regarder ce qu\\''on a acheter pour la phase outdoor l\\''ann&eacute;e pass&eacute;e &agrave; la musau... t\\''as encore les tickets de caisses je pense ?&nbsp;</p>', 1326877486, 8, 114),
(65, '<p>Oui, on a commenc&eacute; &agrave; en parler avec Emilien.&nbsp;</p>\r\n<p>Je suis entrain de faire une liste de course en m\\''inspirant des listes que j\\''ai gard&eacute;es.&nbsp;</p>\r\n<p>Je compte environ 100 personnes? plus ? (11 &eacute;quipes*9 joueurs en moyenne?)</p>\r\n<p>Je vais la soumettre en petit comit&eacute; pour qu\\''on se mette d\\''accord.&nbsp;</p>', 1327351220, 8, 136),
(66, '<p>Ah tien, j\\''y pense,&nbsp;</p>\r\n<p>Je pense prendre des boissons consign&eacute;es, d&eacute;veloppement durable oblige. C\\''est chiant de rapporter les consignes mais bon, il faut le faire, on est en 2012 ; )</p>\r\n<p>Donc faudra passer le mot au joueurs que tout est consign&eacute;.</p>\r\n<p>Dire aux joueurs de rapporter leurs couverts ! &ccedil;a fait r&eacute;chauff&eacute;, mais on est en 2012 et y a des gens qui n\\''y pensent pas. Et on va &eacute;viter l\\''overdose de plastique jetable m&ecirc;me si je vais en acheter un peu par s&eacute;curit&eacute;.</p>\r\n<p>&nbsp;</p>', 1327351741, 8, 136),
(67, '<p>C\\''est encore moi, je vois qu\\''on avait ach&eacute;t&eacute; pour Erstein cet &eacute;t&eacute; des bacs ronds pour les salades, &ccedil;a sera l\\''occasion de les ressortir. Faudrait les filer &agrave; ceux qui se proposent de faire le service de salade industriel, genre Dides.</p>\r\n<p>Claire, c\\''est vous qui les avez &agrave; la maison ?</p>\r\n<p>Ressortir les verres en plastiques, m&ecirc;me question, qui les a?</p>\r\n<p>Y a t\\''il un reste de couverts en plastique jetables qui n\\''auraient pas &eacute;t&eacute; consomm&eacute;s &agrave; Erstein?</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 1327353126, 8, 136),
(70, '<p>Fab : pour les choses qu\\''on a chez nous ( &agrave; Mundo)</p>\r\n<p>je ferai le point d&eacute;but de semaine prochaine (apr&egrave;s Prague) et je te dirai, OK !</p>\r\n<p>les gobelets je crois que c\\''est Did qui les a stock&eacute;s, &agrave; v&eacute;rifier</p>\r\n<p>les bacs &agrave; salade, ca me dit rien de les avoir chez nous</p>\r\n<p>Si Laurent ramene un percolateur, alors pas besoin des thermos qu\\''on a chez nous.</p>\r\n<p>&nbsp;</p>\r\n<p>Par ailleurs, il va falloir trouver des MACHINES A CROQ en nb !</p>\r\n<p>Je ne suis pas contre de preter la notre, mais un peu plus d\\''&eacute;gard sur le mat&eacute;riel d\\''autrui serait une bonne r&eacute;solution, j\\''avais pourtant expr&egrave;s ramen&eacute; des spatules en bois &agrave; ertein ...</p>', 1327405249, 8, 116),
(71, '<p>Les gobelets sont chez mes parents dans le haut-rhin, mais je vais trouver un moyen pour les faire rapatrier, avec le percolateur ...</p>\r\n<p>Pour le reste comme j\\''ai pu te le dire en priv&eacute; &agrave; Fab, il est pas n&eacute;cessaire de donner des bouteilles d\\''eau aux &eacute;quipes, ils n\\''auront qu\\''&agrave; ramener leurs gourdes, et au pire les vestiaires ne sont pas tr&egrave;s loin pour aller y boire.&nbsp;</p>\r\n<p>Pour les bacs, je pense vraiment que c\\''est dides qui les a chez lui.&nbsp;</p>', 1327479025, 8, 114),
(73, '<p>Salut tout le monde,</p>\r\n<p>Maintenant qu\\''on a un super forum, je vais pouvoir bien le pourrir! <img title=\\"Rigolant\\" src=\\"tinymce/plugins/emotions/img/smiley-laughing.gif\\" border=\\"0\\" alt=\\"Rigolant\\" /></p>\r\n<p>Non, plus s&eacute;rieusemen, nous organisons une soir&eacute;e \\"One Man Band\\" au Molodoi le Jeudi 9 F&eacute;vrier 2012. ce sera pluto&ocirc;t du blues et du rock progressif donc passez faire un tour: la musique sera sympa!</p>\r\n<p>Et pour certains ce sera une bonne occasion de d&eacute;couvrir le Molodoi!</p>\r\n<p>Pour plus d\\''infos, rendez-vous sur le site du Molodoi :)</p>', 1327480791, 10, 130),
(74, '<p>Et ne pas oublier de mettre les droits dans la charte :)</p>\r\n<p>(A r&eacute;p&eacute;ter &agrave; haute voix)</p>', 1327480902, 3, 130),
(75, '<p>Salut &agrave; tous !</p>\r\n<p>Comme je l\\''ai d&eacute;j&agrave; pr&eacute;cis&eacute;, je serai l&agrave; le samedi matin pour aider &agrave; mettre en place tout le matos.</p>', 1327488055, 8, 117),
(76, '<p>Bonne nouvelle &ccedil;a! :)</p>', 1327488877, 4, 130),
(77, '<p>et l\\''entra&icirc;nement du SUAPS dans tout &ccedil;a ?? hein ?&nbsp;</p>', 1327504350, 10, 114),
(78, '<p>suis pas sur, mais je crois qu\\''il s\\''asseoit dessus :)</p>', 1327508301, 10, 123),
(79, '<p>Bah, je ne rate presque jamais un entrainement alors bon, si j\\''en rate un ce sera pas la mort je pense :)</p>\r\n<p>Et puis j\\''y suis pour rien moi, je dis tout le temps que le jeudi c\\''est mort mais quand y\\''a pas la choix, y\\''a pas le choix: tu prends les dates qui sont disponibles.</p>', 1327566486, 10, 130),
(81, '<p>tin les boules trop tard <img title=\\"En pleurs\\" src=\\"tinymce/plugins/emotions/img/smiley-cry.gif\\" border=\\"0\\" alt=\\"En pleurs\\" /></p>', 1327609821, 9, 123),
(86, '<p>c\\''est vrai que tu dois pas &ecirc;tre mauvais en slammer fou, Ouist !</p>', 1327765439, 9, 143),
(87, '<p><em>Je pr&eacute;pare ma sp&eacute;cialit&eacute; : deux g&acirc;teaux au chocolat. </em></p>\r\n<p><em>Sinon, niveau matos, je peux apporter une table &agrave; tr&eacute;teaux s\\''il y a besoin. Qui connait d&eacute;j&agrave; le gymnase et le mobilier existant ?</em></p>', 1327765581, 8, 143),
(88, '<p>Je peux ramener 1 (peut-&ecirc;tre m&ecirc;me 2...!) appareils &agrave; croque-monsieur !</p>\r\n<p>Par contre, comme je termine &agrave; midi le samedi, ils seront pas l&agrave; avant 13h et quelques.. A moins que je les passe &agrave; quelqu\\''un la veille.</p>', 1327933780, 8, 139),
(91, '<p>Qui fait des salades ?</p>\r\n<p>Dides, des lentilles, c\\''est &ccedil;a?</p>\r\n<p>Qui pour la salade de p&acirc;te, le taboul&eacute;, la v&eacute;g&eacute;tarienne tomate/salade... ,la patate/knacky/lardon/fromage...</p>\r\n<p>5 ou 6 grosses salades devraient faire l\\''affaire.</p>\r\n<p>On en est o&ugrave; dans la recherche des bassines achet&eacute;es pour Erstein?&nbsp;</p>', 1327945729, 8, 136),
(92, '<p>moi je peux ramener un appareil &agrave; croque si besoin est.</p>\r\n<p>Je fais aussi un gateau mais quoi, aucune idee...</p>', 1327994355, 8, 121),
(93, '<p>Je pensais &agrave; une soupe : vue les temp&eacute;ratures de dingue qu\\''on va avoir ...</p>\r\n<p>mais est-ce que quelqu\\''un a des plaques electriques ?</p>\r\n<p>Claire</p>', 1328043194, 8, 116),
(94, '<p>serais present le dimanche, pour filer un coup de main.</p>\r\n<p>je preparerai un sucr&eacute;.</p>', 1328087862, 8, 123),
(95, '<p>ok pour la plaque &eacute;lectrique, je prends la mienne, elle marche bien mais elle est pas tr&egrave;s tr&egrave;s grosse...</p>\r\n<p>je prends un ou deux fait-touts pour la soupe... Faut des bouilloires, plus facile pour monter l\\''eau &agrave; &eacute;bulition, j\\''en ai une de 1L environ... Si vous en avez des plus grosses, n\\''h&eacute;sitez pas.</p>\r\n<p>Ma machine &agrave; caf&eacute; coule relativement vite, je peux la prendre si besoin. Dites moi.</p>', 1328091292, 8, 131),
(96, '<p>Les lentilles, c\\''est moi (et Schmidt, pour les publivores !).</p>\r\n<p>Sinon je peux &ecirc;tre l&agrave; samedi en fin de matin&eacute;e, le plus t&ocirc;t possible en tout cas ^^&nbsp;</p>', 1328111414, 8, 129),
(97, '<p>Salut tout le monde,</p>\r\n<p>Alors je n\\''ai malheureusement pas pu r&eacute;cup&eacute;rer les gobelets et la perco dans la vall&eacute;e...</p>\r\n<p>Je ram&egrave;ne une machine &agrave; caf&eacute;, il en faudra peut &ecirc;tre deux ou trois...</p>\r\n<p>Je ferai un g&acirc;teau et de la salade v&eacute;g&eacute; !&nbsp;</p>\r\n<p>Claire, tu as r&eacute;cup&eacute;r&eacute; les cl&eacute;s ? tu ouvriras les portes &agrave; quelle heure ? &nbsp;</p>', 1328118249, 8, 114),
(98, '<p>Coucou,</p>\r\n<p>&nbsp;</p>\r\n<p>Je peux &ecirc;tre l&agrave; le samedi ou le dimanche pour le rusch de la buvette, dites moi l&agrave; o&ugrave; vous manquez de monde. Je prends ma boulloire (1L).</p>\r\n<p>Laurent, est ce que tu veux que je tente de r&eacute;cup&eacute;rer les 70 &eacute;co cup de campus vert?</p>\r\n<p>&nbsp;</p>\r\n<p>Fannie</p>', 1328122958, 8, 155),
(99, '<p>oui fannie, &ccedil;a peut &ecirc;tre cool !</p>', 1328123101, 8, 114),
(100, '<p>Finalement, je pr&eacute;f&egrave;rerai le samedi pour la buvette. Vous pouvez &eacute;galement compter sur baptiste &agrave; partir de 12h30.</p>', 1328128067, 8, 155),
(101, '<p>Je peux faire une salade pour le dimanche et aussi aider &agrave; tenir la buvette le dimanche midi ! Pas d\\''appareil dispo pour moi, &agrave; part une bouilloire. &ccedil;a int&eacute;resse ?</p>\r\n<p>Anne Laure</p>', 1328134611, 8, 137),
(102, '<p>J\\''apporte une cafeti&egrave;re, &ccedil;a devrait faire le compte. Claire, Laurent, Fab, y a-t-il besoin d\\''autre mat&eacute;riel ?</p>', 1328183193, 8, 143),
(103, '<p>mise &agrave; dispo du gymnase &agrave; partir de 10h00 samedi matin&nbsp; c Fab qui aura les <strong>cl&eacute;s</strong></p>\r\n<p>(il faut d\\''ailleurs qu\\''il redemande si c bien la meme cl&eacute; qui ouvre tt, notamment le local \\"buvette\\")</p>\r\n<p>Si Fab et Emilien n\\''ont pas trop longtps besoin de moi vendredi soir &agrave; la sortie d\\''Eurocash, je ferai une <strong>soupe de potiron.</strong> (Emilien ramenera sa plaque &eacute;lectrique)</p>\r\n<p>A ceux qui font des salades ou gateau : <strong>PENSEZ &agrave; EMMENER couteaux/couverts &agrave; salade</strong>&nbsp; ! (mettez votre nom dessus avec un scotch si besoin)</p>\r\n<p>NB : il n\\''y a <strong>pas de frigo sur place</strong></p>\r\n<p>et par ailleurs il y a un LECLERC EXPRESS au bout de la rue (pres du terminus du tram)</p>\r\n<p>Est-ce qu\\''on fait des <strong>gauffres ? </strong>si oui, est-ce que qqn se propose pour faire de la p&acirc;te ?</p>\r\n<p><strong>LAURENT et EMILIEN</strong> je crois : <strong>emmenez vos machines &agrave; caf&eacute; avec qq filtres</strong> adapt&eacute;s</p>\r\n<p>je ramenerai les 2 thermos du club pour le stocker au chaud</p>\r\n<p>Il faut des gens &agrave; la buvette aux heures de pointe (avant pr&eacute;parer des croques), mais aussi pour mise en place et fermeture ! pensez y</p>', 1328184016, 8, 116),
(104, '<p>alors moi je suis dispo (pour le moment)&nbsp;tout le week-end (sauf dimanche apr&egrave;s la finale pour cause de covoiturages)!</p>', 1328190977, 8, 121),
(105, '<p>Hello!</p>\r\n<p>Je serai l&agrave; en fin de matin&eacute;e, avec un g&acirc;teau au chocolat, une salade compos&eacute;e, ma&iuml;s thon...</p>\r\n<p>J\\''ai aussi deux petits pain d\\''&eacute;pices &agrave; vendre (Fortwenger), cadeaux de No&euml;l, &agrave; consommer avant mi f&eacute;vrier... on n\\''en peut plus de manger du pain d\\''&eacute;pices ici!!!</p>\r\n<p>Et j\\''ai une copine qui travaille chez Mars &agrave; Haguenau, j\\''ai r&eacute;cup&eacute;r&eacute; 10 barres Mars et 4x2 barres de Balisto + &nbsp;10 Kinder Maxi &agrave; vendre, donc n\\''achetez pas trop de sucreries ;-)))</p>\r\n<p>J\\''ai aussi une rallonge que je peux mettre &agrave; dispo...&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&agrave;++ &nbsp;Scoubi</p>', 1328212957, 8, 142),
(106, '<p>Euh vu les quantit&eacute;s de barres chocolat&eacute;es que t\\''indiques, &ccedil;a fait pas grand chose !&nbsp;</p>', 1328219030, 8, 129),
(108, '<p>Il &eacute;tait pas en classe Ben?? ? la chance lol</p>', 1328640857, 6, 142),
(111, '<p>tu travailles souvent le samedi apr&egrave;m\\'' toi ?</p>', 1328728601, 6, 143),
(112, '<p>sacr&eacute; Ben, le message de Fab datant d\\''hier, nous &eacute;tions en droit de nous demander, non?? samedi, ce n\\''&eacute;tait pas le 7?? si...???</p>', 1328735545, 6, 142),
(115, '<p>Scoubi, qu\\''as-tu fum&eacute; cette semaine ? Relis &agrave; nouveau la date du msg de Fab, d\\''ailleurs ton d&eacute;lai de r&eacute;ponse me surprend :)</p>', 1328813126, 6, 143),
(117, '<p>07 janvier pas 7 f&eacute;vrier Scoubi :)</p>', 1328824063, 6, 150),
(118, '<p>Alors c\\''&eacute;tait comment ?</p>', 1328876337, 13, 116),
(119, '<p>Merci beaucoup les gens : surtout Fab pour tte cette logistique d\\''avt -apr&egrave;s , Lulu et Fanny surtout pour votre super pr&eacute;sence &agrave; la Buvette et votre bonne humeur !!</p>\r\n<p>&nbsp;</p>\r\n<p>Sur la fin , dommage que bcp filent &agrave; l\\''anglaise un peu vite ...</p>\r\n<p>&nbsp;</p>\r\n<p>Fab le rendu des cl&eacute;s s\\''est bien pass&eacute; ? (il faudrait que je leur envoie un mail pr remercier !)</p>', 1328876601, 14, 116),
(120, '<p>Tout &agrave; fait Hugo, et fort heureusement d\\''ailleurs car je n\\''aurai jamais mis le nez dehors pour du disc golf avec ces t&deg; polaires.</p>', 1328891386, 6, 143),
(122, '<p>Sacr&eacute; WE, puisqu\\''on retrouve :</p>\r\n<p>&nbsp;</p>\r\n<p>- le retour D3 outdoor (si la date est confirm&eacute;e)</p>\r\n<p>- le tournoi sur plage de Bibione (It) (4 jours, puisque c\\''est le we du 1er mai) (o&ugrave; le club a une &eacute;quipe inscrite)</p>\r\n<p>(- le Force Lake de Lausanne : HAT)&nbsp; (o&ugrave; j\\''ai un titre &agrave; d&eacute;fendre... j\\''le redis juste pour la frime..h&eacute; ouais..)</p>\r\n<p>&nbsp;</p>\r\n<p>On peut constater qu\\''il y aura apparement au moins 25 joueurs pour l\\''outdoor. Qu\\''en pensent certains membres du comit&eacute; sportif, &agrave; premi&egrave;re vue ?&nbsp; y\\''aura-t-il 2 &eacute;quipes outdoor en championnat ?&nbsp; S\\''il y en a qu\\''une, les autres pourront se retourner vers ces tournois, doit-on d&eacute;j&agrave; en parler ?</p>\r\n<p>&nbsp;</p>\r\n<p>C\\''est beau de faire des phrases du J.O., pour une question toute simple...&nbsp; :D</p>', 1328898951, 15, 120),
(123, '<p>c\\''est pas l\\''ann&eacute;e des 15 ans ??&nbsp;&nbsp; &ccedil;a se f&ecirc;te &ccedil;a !&nbsp;&nbsp;&nbsp; ;)</p>', 1328900297, 16, 120),
(124, '<p>OUi, sans probl&egrave;me. Ils ont demand&eacute; vite fairt si &ccedil;a s\\''&eacute;tait bbien pass&eacute;. J\\''ai dit qu\\''on &eacute;tait contents. Voil&agrave;.</p>', 1328948150, 14, 136),
(125, '<p>oui C&eacute;d, c\\''est fait, avec la soir&eacute;e restau+trou du 13 janvier, tu proposes d\\''autres \\"comm&eacute;morations\\" ?</p>', 1328951018, 16, 143),
(126, '<p>Est-ce que quelqu\\''un s\\''occupe d&eacute;j&agrave; de tous les &eacute;ventuels gadgets, tshirts, ou autres choses qu\\''on pourrait offrir/vendre aux &eacute;quipes ?</p>\r\n<p>&nbsp;</p>\r\n<p>(histoire qu\\''on ait pas les casquettes apr&egrave;s le tournoi.... &ccedil;a peut arriver... c\\''est peut etre meme d&eacute;j&agrave; arriv&eacute; dans l\\''histoire des tournois)</p>', 1328952831, 17, 120),
(127, '<p>ah oui, c\\''etait pendant ma semaine de vacances en fait....</p>\r\n<p>&nbsp;</p>\r\n<p>mais sinon faudra faire qqch au franchement KYM alors !!</p>', 1328953345, 16, 120),
(128, '<p>Je pense que cela est correctible, il faudrait peut etre voir ca avec les mises en ligneur du site, mais serait-il possible de changer l\\''ordre des topic sur le forum ?&nbsp; Le plus r&eacute;cent se retrouvant en bas de page, ce qui n\\''est pas glop.</p>\r\n<p>&nbsp;</p>\r\n<p>Aussi, j\\''essaye d\\''&eacute;crire depuis Android sur le site, mais ca ne marhe pas. Je peux consulter et faire afficher l\\''encadr&eacute; de r&eacute;ponse, mais je ne peux rien inscrire dedans. Les utilisateurs d\\''Iphone et windowsphone ont le meme probleme ?&nbsp;&nbsp; &ccedil;a peut etre pratique.</p>\r\n<p>Merci service.</p>', 1328953585, 18, 120),
(129, '<p>De plus, serait-il possible de rajouter une \\"signature\\" en bas de page &agrave; chaque fois qu\\''on &eacute;crit qqch ?</p>', 1328954297, 18, 120),
(130, 'Ce message est Ã©crit depuis un iPhone, donc apriori c\\''est ok.', 1328956687, 18, 150),
(132, '<p>ah ben merci bien, bonne nouvelle Hugo d&eacute;lire&nbsp;&nbsp; ;)</p>', 1328963514, 18, 120),
(133, '<p>&ccedil;a sera fait, t\\''inqui&egrave;te !</p>', 1328986735, 17, 114),
(135, '<p>les 15 ans c\\''est en 2013 !</p>\r\n<p>Ced, tu veux faire parti du comit&eacute; des fetes ?</p>', 1329041582, 16, 116),
(141, '<p>Ben faudra voir avec celui qui a dit que dans la rubrique sur le club, que la cr&eacute;ation etait en 1997 !!!</p>\r\n<p>&nbsp;</p>\r\n<p>D\\''ou ma question !!!&nbsp;&nbsp; ;)</p>', 1329251847, 16, 120),
(142, '<p>Salut tout le monde,&nbsp;</p>\r\n<p>La mayonnaise prend superbement bien, d&eacute;j&agrave; 10 &eacute;quipes int&eacute;ress&eacute;es...&nbsp;</p>\r\n<p>- 4 allemandes&nbsp;</p>\r\n<p>- 3 suisses&nbsp;</p>\r\n<p>- 3 fran&ccedil;aises&nbsp;</p>\r\n<p>Tout ce que je peux dire c\\''est que le niveau monte s&eacute;rieusement !!</p>', 1329295546, 19, 114),
(143, '<p>Salut Ced, il a &eacute;t&eacute; d&eacute;cid&eacute; que 2 &eacute;quipes seraient align&eacute;es en championnat OUtdoor !&nbsp;</p>', 1329295697, 15, 114),
(145, '<p>Y\\''a du contenu qui a &eacute;t&eacute; rajout&eacute; par Laurent sur ces pages \\"club\\" et c\\''est tr&eacute;s bien.</p>\r\n<p>Mais je crois qu\\''il y a 2/3 trucs &agrave; corriger ... Notamment la cr&eacute;ation de la section n\\''est pas du tout &agrave; l\\''initiative d\\''Alban !! mais &agrave; celle de Mario TOMASI (avec Guy APPEYRE je crois) comme je le disais dans un mail de ce d&eacute;but janvier.</p>\r\n<p>&nbsp;</p>', 1329306704, 16, 116),
(147, '<p>11 (nouvelle inscription allemande)&nbsp;</p>', 1329312636, 19, 114),
(148, '<p>Mais Ced il y a not&eacute; 1998, et pas 1997... t\\''es bourr&eacute; ?&nbsp;</p>\r\n<p>Pour Claire, je changerai &ccedil;a tr&egrave;s rapidement.&nbsp;</p>', 1329318615, 16, 114),
(149, '<p>ah ben ouais, ben si ensuite on change les dates pour que j\\''ai faux, merci bien !</p>\r\n<p>&nbsp;</p>\r\n<p>en attendant y\\''en a quand meme un qui a cru qu\\''en janvier au resto on f&ecirc;tait les 15 ans du club.........&nbsp; ich sage das, ich sage nichts</p>', 1329338849, 16, 120),
(150, '<p>bon pour cette date de creation il faut v&eacute;rifier ...</p>', 1329393286, 16, 116),
(158, '<p>salut tout le monde,</p>\r\n<p>&nbsp;</p>\r\n<p>ce n\\''est plus une surprise a ce jour, mais je tenais a laisser une trace sur le fofo et j\\''ai bien LE fofo ( j\\''entend deja certains esprits mals tourn&eacute;s).</p>\r\n<p>plus serieux. c\\''est en faisant un Hold-Up que l\\''Equipe 1 a pu pretendre &agrave; jouer la mont&eacute;e en N1, une equipe nouvelle dans sa composition puisque pr&egrave;s de 50% de l\\''effectif a chang&eacute;. Ceci a eu pas mal d\\''impact, notamment sur le type de jeu mis en place.</p>\r\n<p>Holp-Up carrement puisqu\\''&agrave; la phase Aller, nous reussissons a terminer 3&egrave;me de poule avec <span style=\\"text-decoration: underline;\\">2 victoires pour 3 defaites</span>. le pointaverage etant en notre faveur.</p>\r\n<p>Pour rappel l\\''ann&eacute;e precedente, nous avions deja vecu cette situation. Si les fins se ressemblent,les maniere sont toutes autres.</p>\r\n<p>Pour la phase Retour, alors que nos amis FB de la FC jouant TB voir meme TTB, ont termin&eacute; Champion de N2.</p>\r\n<p>Nous sommes sorti de cette phase 2&egrave;me ex aequo, avec cette fois-ci <span style=\\"text-decoration: underline;\\">3 vistoires et 2 defaites</span>, avec Tsunamis et Magic-Disc. Mais dans les belles histoires il y a toujours un mais :), le pointaverage nous sera, cette fois-ci, fatal.</p>\r\n<p>En effet, nous soldons l\\''affaire &agrave; -5 pts, nous placant &agrave; la 4&egrave;me place, derriere Magic-disc et Tsunamis.</p>\r\n<p>Ce qui nous empechera de suivre les FB en N1.</p>\r\n<p>Cependant, j\\''ai une petite satisfaction qui me semble etre partag&eacute;e par certains. Notre victoire contre les champions. He Oui, <em><span style=\\"text-decoration: underline;\\">notre club est le seul de l\\''ensemble des equipes presentes en N2 ce WE</span></em>, a avoir su construire une defense et etablir une attaque, qui ont empech&eacute; les champions de faire le Grand-Chelem (Aller/Retour).</p>\r\n<p>Encore un grand merci &agrave; toutes celles et ceux qui de pres ou de loin ont pens&eacute; &agrave; nous et nous ont soutenu.</p>\r\n<p>&nbsp;</p>\r\n<p>l\\''indoor est aujourd\\''hui dans les mains des equipes 2 / 3 / 3bis.</p>\r\n<p>j\\''en terminerai en disant :</p>\r\n<p>Go Sesqui GO Sesqui GO !!!</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>petite pens&eacute;e au Psycho, que nous retrouverons en N2 et Everest pour qui tout se joue ce WE.</p>', 1329766967, 20, 123),
(159, '<p>Merci pour ton compte-rendu Ouist, et bravo pour votre WE lors duquel vous n\\''&ecirc;tes pas pass&eacute; loin de la mont&eacute;e, encore un petit effort et l\\''an prochain il y a toutes les raisons d\\''y croire.</p>\r\n<p>Petit erratum sur ta phrase concernant les FB : ils \\"ont termin&eacute;\\" et non pas \\"on terminait\\" ce qui en change radicalement le sens.</p>', 1329769204, 20, 143),
(160, '<p>je vois pas de quoi tu parles ;)</p>', 1329772165, 20, 123),
(163, '<p>Salut les moches !!!  Ready to GO ?  Op&eacute;ration voiture ? Heure de d&eacute;part ?  Kiss ;)</p>', 1329990253, 21, 123),
(166, '<p>bravo ! next time it\\''s for U !</p>', 1330366022, 20, 116),
(167, '<p>coucou !</p>\r\n<p>y\\''a des gens pour courir et/ou exos un soir cette semaine&nbsp; ...</p>\r\n<p>les play-offs approchent ...</p>', 1330366133, 22, 116),
(168, '<p>Depuis la Suisse, difficile, sauf avec web-cam frontale ;)</p>\r\n<p>Mais &agrave; partir de demain je ferai chaque jour &mdash; tout seul comme un con dans ma chambre &mdash; tous les &eacute;chauffements de Mister Kos !&nbsp;</p>', 1330426677, 22, 129),
(169, '<p>Kos toujours... (desole pour cette affreuse blague...)</p>', 1330427003, 22, 121),
(170, '<p>Mais non, je suis tout entier acquis &agrave; ta kos sur ce genre d\\''humour ^^&nbsp;</p>', 1330447824, 22, 129),
(171, '<p>Hello,</p>\r\n<p>&nbsp;</p>\r\n<p>je voulais savoir si la location du minibus se confirmait.</p>\r\n<p>Dites-moi si vous avez besoin de moi comme conducteur mais j\\''ai 23 ans donc je sais pas si ca passe.</p>', 1330524649, 23, 121),
(172, '<p>COUCOU !</p>\r\n<p>j\\''ai une suggestion/id&eacute;e pour la page \\"news\\" :</p>\r\n<p>est-ce c\\''est toujours oblig&eacute; de nous afficher nous-m&ecirc;me pour illustrer un evenement ?</p>\r\n<p>genre on pourrait mettre &agrave; l\\''honneur le vainqueur de telle ou telle comp&egrave;t par ex.</p>\r\n<p>enfin c t dans l\\''id&eacute;e de ne pas &ecirc;tre sectaire</p>\r\n<p>bon ben sinon Bonnes vacances aux veinards qui en ont et bon tournoi &agrave; Pilsen !</p>\r\n<p>&nbsp;</p>\r\n<p>question bonus : Mais o&ugrave; sont les photos faites par David pour nous illustrer sur le forum ?</p>', 1330602214, 18, 116),
(173, '<p>Merci les gars pour votre sollicitude&nbsp; et vos blagues rigolotes</p>\r\n<p>heu mais &agrave; part &ccedil;a on s\\''ennuit un peu ici, &ccedil;a manque de fr&eacute;quentation</p>\r\n<p>Bonne pr&eacute;pa &agrave; vous, see u Friday evening !</p>', 1330602336, 22, 116),
(174, '<p>plop ...</p>\r\n<p>ben je crois que c\\''est 5 ans de permis minimum</p>\r\n<p>mais la r&eacute;sa est bien dans les tuyaux</p>\r\n<p>Et pour l\\''hebergement ce sera 32&euro; Nuit + repas + petit dej (pas besoin de duvet) gymnase et hebergement sont tt proche d\\''apr&egrave;s ce que j\\''ai compris</p>\r\n<p>Nb: il va falloir trouver un F1 pour faire &eacute;tape sur la route vendredi soir</p>', 1330602763, 23, 116),
(175, '<p>c\\''est vrai &ccedil;a manque de blagues kostiques ce forum...</p>', 1330613511, 22, 143),
(176, '<p>je pourrai rouler &eacute;galement !</p>', 1330630677, 23, 114),
(177, '<p>Y aurait-il des personnes motiv&eacute;es pour lancer tranquillement demain apr&egrave;m\\'' (samedi 03/03) &agrave; l\\''orangerie ou &agrave; la citadelle ?</p>', 1330703938, 24, 143),
(178, '<p>Demain samedi 3 mars 14h00 au parc Schweitzer du Creps; rue du Schnokeloch</p>\r\n<p>DG, initiation possible (je pr&ecirc;te des disques), et pour ceux qui veulent retaquiner de la corbeille comme dans le bon vieux temps...</p>\r\n<p>J\\''y serai avec Jean-Louis.&nbsp;</p>\r\n<p>A demain peut-&ecirc;tre</p>', 1330718624, 6, 136),
(179, '<p>Ah, et bien j\\''en serai peut-&ecirc;tre (et j\\''am&egrave;nerai un disque de 175g, un vrai)</p>', 1330719740, 6, 143),
(180, '<p>Salut !</p>\r\n<p>Merci pour ces d&eacute;dicaces ;) En ce qui concerne la pr&eacute;pa physique, je suis tous les mardis soir au parc de la citadelle &agrave; 19h pour des s&eacute;ances. Avis aux amateurs.</p>\r\n<p>A bient&ocirc;t</p>', 1330775288, 22, 117),
(181, '<p>c\\''est &agrave; Mannheim que tu dois etre pour ma prepa physique :p :p</p>', 1330934116, 22, 121),
(182, '<p>6 matchs par WE lors de cette phase outdoor, &ccedil;a donne envie d\\''y &ecirc;tre !</p>\r\n<p><a href=\\"http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Outdoor/Open-Division-3/Est\\">http://www.ffdf.fr/Ultimate/Resultats-federaux/Saison-Federale-2011-2012/Outdoor/Open-Division-3/Est</a></p>', 1330954892, 15, 143),
(183, '<p>25 ans et 3 ans de permis</p>\r\n<p>3 conducteurs possibles -&gt; merci de me scanner vos permis</p>\r\n<p>&nbsp;</p>', 1331014956, 23, 116),
(184, '<p>ah ben c\\''est mort pour moi, desole!</p>', 1331018263, 23, 121),
(185, '<p>t\\''inqui&egrave;te pas Niko, la majorit&eacute; c\\''est pour bient&ocirc;t !</p>', 1331051179, 23, 143),
(186, '<p>Laurent :</p>\r\n<p>&nbsp;</p>\r\n<p>tu pourrais annoncer les play-offs et les journ&eacute;es de championnat outdoor ?</p>', 1331120769, 18, 116),
(187, '<p>Bon ben j\\''vois qu\\''c mort ici ... tout se passe sur Face de bouc alors !?</p>\r\n<p>la barbe :o(</p>', 1331811318, 18, 116),
(188, '<p>au fait, t\\''es qui \\"p&eacute;pite\\" ??</p>', 1331933815, 18, 120),
(189, '<p>pourtant je pense que les autres avait compris</p>\r\n<p>si tu regardes mes autres postes sur le forum</p>\r\n<p>et surtout mon dernier sur ce sujet</p>', 1331969998, 18, 116),
(190, '<p>Dans ton dernier post, tu dis \\"la barbe\\", serais tu une femme a barbe??</p>', 1332099400, 18, 120),
(191, '<p>une femme &agrave; moustachu plut&ocirc;t ^^</p>', 1332195229, 18, 129),
(192, '<p>Bonjour &agrave; toutes et &agrave; tous,</p>\r\n<p>&nbsp;</p>\r\n<p>je venais aux nouvelles concernant les personnes qui mettent &agrave; disposition leur voiture pour se rendre &agrave; Besancon... Je ne pense aps que ce post soit trop t&ocirc;t vu comme on a gal&eacute;r&eacute; pour aller &agrave; Vesoul.</p>', 1332409959, 25, 121),
(193, '<p>haha bel effort niko\\''...</p>\r\n<p>moi je n\\''ai pas d\\''auto...</p>\r\n<p>qui a une auto ?&nbsp;</p>', 1332574421, 25, 114),
(194, '<p>Une voiture avec 2 places de libre.</p>\r\n<p>D&eacute;part vendredi soir ou samedi matin.</p>', 1332668328, 25, 132),
(195, '<p>une voiture, 4 places (moi + 3).</p>\r\n<p>&agrave; demain !</p>', 1332669720, 25, 131),
(196, '<p>a pas de voiture.</p>\r\n<p>&nbsp;</p>\r\n<p>Ouistit</p>', 1332764605, 25, 123),
(197, '<p>Covoiturage possible vers&nbsp;Mundolsheim ce jeudi, d&eacute;part Esplanade (arr&ecirc;t de tram Universit&eacute;) &agrave; 18h30, passage par l\\''avenue des Vosges.</p>\r\n<p>Emil (06.64.00.47.59)</p>', 1332838021, 26, 131),
(198, '<p><span>1/ Meep meep (Pick Up / Swiss)</span><br /><span>2/ Huck Hogan Handlebar Mustache (Pick Up / France)</span><br /><span>3/ Crazy Dogs (Stans / Swiss)</span><br /><span class=\\"text_exposed_show\\">4/ Sean\\''s Sheep (Beckum / Germany)&nbsp;<br />5/ Forest Jump (Ilmenau / Germany)<br />6/ Gummib&auml;rchen (Karlsruhe / Germany)&nbsp;<br />7/ Hechte Kaiserslautern (Kaiserslautern / Germany)<br />8/ Free-Vol (Voujeaucourt / France)<br />9/ Feldpenner (Mainz / Germany)&nbsp;<br />10/ Friz\\''bisontins (Besan&ccedil;on / France) SOTG KYM\\''11<br />11/ Free2Speed (Basel / Swiss)<br />12/ Zuris&auml;ck (Zurich / Swiss)<br />13/ Good Old Boys (Pick Up / Germany) Winners KYM\\''11<br />14/ Wizards (Gen&egrave;ve / Swiss)&nbsp;<br />15/ Team S&uuml;dsee (Konstanz / Germany)<br />16/ Bad Raps (Bad Rappenau / Germany)</span></p>', 1333533305, 27, 114),
(199, '<p>Y\\''aura du niveau !</p>\r\n<p>Et sinon, niveau linguistique, 3 &eacute;quipes francophones sur 16, pour ceux qui ne parlent pas un mot d\\''Allemand &ccedil;a va &ecirc;tre coton :) &nbsp;&nbsp;Perso, je reprendrai mon accent franc-comtois pour communiquer avec les &eacute;quipes doubistes.</p>', 1333738675, 27, 143),
(200, '<p>Salut tout le monde,</p>\r\n<p>une precision sur le travel, apres une situation v&eacute;cue par l\\''equipe 1 lors de la phase Aller de l\\''outdoor.</p>\r\n<p>&nbsp;</p>\r\n<p>situation :</p>\r\n<p style=\\"padding-left: 30px;\\">le lanceur, apres avoir etablit son point de pivot a l\\''interieur du terrain, s\\''est retrouv&eacute; lors du mouvement avec son pied de pivot en dehors de l\\''aire de jeu.</p>\r\n<p style=\\"padding-left: 30px;\\">&nbsp;</p>\r\n<p>reglement :</p>\r\n<p style=\\"padding-left: 30px;\\">18.2.6.5. le lanceur ne conserve pas le contact avec l&rsquo;aire de jeu durant tout le mouvement du lancer.</p>\r\n<p style=\\"padding-left: 30px;\\">rappel : l\\''aire de jeu est compos&eacute;e du terrain centrale et des 2 en-buts</p>\r\n<p><span style=\\"text-decoration: underline;\\"><strong><span style=\\"background-color: #ffffff; color: #ff0000;\\">Il y a Travel et non turn-over.</span></strong></span></p>', 1333810122, 28, 123),
(201, '<p>merci Ouist, c\\''est toujours utile. C\\''est bien ce que je pensais en plus ! ! ! ;) ;)</p>', 1333875229, 28, 121),
(202, '<p>Puisqu\\''on parle de travel...</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\\"http://www.youtube.com/watch?v=x5cG4aFJBMI&amp;\\">http://www.youtube.com/watch?v=x5cG4aFJBMI&amp;</a></p>\r\n<p>&nbsp;</p>\r\n<p>A 31min50, travel or not ?</p>', 1334094526, 28, 150),
(203, '<p>Pas travel, ils lachent le disque sur leur 2e appel, donc c\\''est bon.</p>\r\n<p>&nbsp;</p>\r\n<p>Par contre, si toi tu fais ca, tu te feras appel&eacute; travel, peu de joueurs accepte cet &eacute;change de 1-2 sans appel&eacute; quoi que ce soit.</p>', 1334334341, 28, 132),
(204, '<p>et en plus y\\''a klopstock sur le carreau pour l\\''instant, et eux, ce sont pas des peintres !!! ;)</p>', 1334684898, 27, 120),
(205, '<p>selon la r&egrave;gle, il me semble qu\\''il faut pas changer ni de direction, ni de vitesse.</p>\r\n<p>On dirait qu\\''ils s\\''y appliquent bien.</p>\r\n<p>&nbsp;</p>\r\n<p>Par contre sur la passe dec, le pied de pivot d&eacute;colle bien... Perso, je dirais rien en match parce que le mec ca lui apporte rien dans son mouvement....&nbsp; mais si tu veux &ecirc;tre filou, tu peux l\\''appeller, vu que ca se joue au bout du bout de la pointe du crampon... certaines nationalit&eacute;s l\\''appelleraient...</p>', 1334685332, 28, 120),
(206, '<p>au vu du ralenti qui suit, on dirait que la derni&egrave;re passe est quand meme bonne....</p>', 1334685510, 28, 120),
(207, '<p>Hello!</p>\r\n<p>&nbsp;</p>\r\n<p>Ne pouvant pas passer ce soir en raison du d&eacute;bat t&eacute;l&eacute; et de baby sitting de mes 2 enfants...</p>\r\n<p>Je redis ici que si je peux aider &agrave; quoi que ce soit pour le KYM 2012 ;-)</p>\r\n<p>Je sais que le club veut vendre de la bi&egrave;re, donc on va ptet pas leur offrir du vin, mais je reste &agrave; dispo pour proposer une bouteille de ros&eacute; dans le package de chaque &eacute;quipe par exemple...</p>\r\n<p>Tenez-moi au jus, je ne serai pas l&agrave; ce w.e l&agrave; &agrave; partir du vendredi soir... mais je peux ptet aider un peu quand m&ecirc;me!</p>\r\n<p>&nbsp;</p>\r\n<p>&agrave;+ &nbsp;Scoubi</p>', 1335944510, 17, 142),
(208, '<p>Tout est dans le titre : pour savoir qui vient, qui sera notre capitaine, qui roule, et tout et tout...</p>', 1337094871, 29, 143),
(209, '<p>Inscrit et toujours motiv&eacute; pour ce tournoi, donc je confirme ma pr&eacute;sence ici pour ne pas polluer la mailing list.</p>', 1337119364, 29, 150),
(210, '<p>Inscrit et toujours super motiv&eacute; &agrave; bloc! :)</p>', 1337155631, 29, 130),
(211, '<p>Du coup quand on call un travel, le compte reprend &agrave; combien?</p>\r\n<p>On arr&ecirc;te le jeu? on continue?</p>', 1337160592, 28, 130),
(212, '<p>Il me semble que le compte reprend l&agrave; o&ugrave; il s\\''&eacute;tait arr&ecirc;t&eacute;, une fois que le pied de pivot est retourn&eacute; l&agrave; o&ugrave; demande le marqueur. Entre temps les autres gringos peuvent bouger.</p>', 1337617450, 28, 120),
(213, '<p>Alors une bonne et une mauvaise nouvelle : je pourrai rouler et ma voiture pourra emmener 5 personnes, mais je ne peux partir que le samedi matin (kermesse de l\\''&eacute;cole de Leno le vendredi 22 au soir).</p>\r\n<p>Attendons le planning du tournoi pour savoir &agrave; quelle heure &ccedil;a nous fait d&eacute;marrer (2 bonnes heures de route).</p>', 1337763177, 29, 143),
(214, '<p>J\\''ai un contre-temps. Il se trouve que j\\''ai une r&eacute;union pour le boulot &agrave; Nancy (30km environ du lieu du tournoi) le samedi dans l\\''apr&egrave;s-midi (j\\''ai pas encore l\\''heure mais probablement vers 14h et &ccedil;a risque de durer jusqu\\''en fin d\\''aprem/d&eacute;but de soir&eacute;e).</p>\r\n<p>Donc je suis toujours disponible le reste du w-e mais pas sur ce cr&eacute;neau horaire o&ugrave; je devrai m\\''absenter.</p>', 1338839775, 29, 150),
(215, '<p>Qui roulera ? A deux voitures &ccedil;a devrait le faire. Comme je prends la mienne (d&eacute;part samedi matin), il ne nous en manque plus qu\\''une...</p>', 1338977038, 29, 143),
(216, '<p>Donc la voiture d\\''Hugo et la mienne, &ccedil;a fait le compte pour les 9 sesquis. Je rappelle que je roule le samedi matin (pour l\\''heure du d&eacute;part, on attend toujours le planning).</p>\r\n<p>Et la Spermull Compagnie, vous y allez quand et comment ? Vous partez avec un handicap sur le terrain si c\\''est un \\"sesqui officiel\\" qui vous emm&egrave;ne ?</p>', 1339686883, 29, 143),
(217, '<p>Lau nous a envoy&eacute; le programme.</p>\r\n<p>Vu que le premier match commence &agrave; 9h30, ce serait bien d\\''y &ecirc;tre vers 8h30 (marge de s&eacute;curit&eacute;).</p>\r\n<p>Du coup faudrait partie vers 06h/06h30...</p>', 1339744079, 29, 130),
(218, 'Benoit, je ne comprends pas ta question de \\"handicap sur le terrain\\" concernant la spermull, peux-tu prÃ©ciser ?', 1339762995, 29, 150),
(219, '<p>c\\''est juste de l\\''humour Hugo, si jamais on tombe sur eux, faudrait qu\\''ils nous donnent un 5-0 d\\''entr&eacute;e ou qu\\''ils lancent de la main gauche (sauf Alex bien s&ucirc;r).</p>', 1339790134, 29, 143),
(220, '<p>outch 6h00 &ccedil;a fait t&ocirc;t Gilles ! je pensais plut&ocirc;t &agrave; 6h45 avec comme objectif d\\''arriver &agrave; 9h00, mais c\\''est &agrave; n&eacute;gocier.</p>', 1339790239, 29, 143),
(221, 'Je suis trop premier degrÃ© ;(', 1339845879, 29, 150),
(222, '<p>On&nbsp;en a&nbsp;un peu parl&eacute;&nbsp;jeudi dernier :&nbsp;Fab y va directement, le vendredi soir. Hugo emm&egrave;ne Roli vendredi soir. Benoit part samedi matin avec Saskia et moi. D&eacute;part vers 6h30. Reste donc des places vendredi et samedi soir pour Taner et&nbsp;Gilles.</p>\r\n<p>TCHO</p>', 1340024086, 29, 137),
(223, '<p>&agrave; quel heure est-ce que tu veux partir Hugo? Je travail jusqu\\''&agrave; 18h... je suis pr&ecirc;t &agrave; partir de 18h30 :-)</p>', 1340029175, 29, 140),
(224, 'Je bosse jusque 18h30 minimum donc le temps de venir sur Strasbourg (ou autre lieu de rdv, Ã§a reste Ã  dÃ©finir) avec la circulation... Ã‡a serait aux alentours de 19h.\r\n\r\nGilles, Taner, vous prÃ©fÃ©rez partir le soir ou le samedi matin ?\r\n\r\n\r\nJe laisse mon num pour ceux qui ont besoin : 0685462011', 1340050432, 29, 150),
(225, '<p>Donc, moi je partirai s&ucirc;rement le vendredi soir vu l\\''heure assez matinale du 1er match.</p>\r\n<p>J\\''irai tout seul comme un grand avec la caisse du boulot car je bosserai lundi et mardi en Meuse.</p>\r\n<p>Je peux prendre ma grande tente pour abriter de 1 &agrave; 4 personne (moi compris).</p>\r\n<p>Dites moi si ya besoin.&nbsp;</p>\r\n<p>Pour le capitana, je veux bien m\\''y coller puisqu\\''il n\\''y aura pas trop de discours en allemands ou en anglais &agrave; faire. ET je serai &agrave; l\\''heure pour le captain meeting.&nbsp;</p>\r\n<p>Sinon, j\\''ai d&eacute;j&agrave; pay&eacute; les players fee et le team fee; &ccedil;a fera 36 euros par personne.</p>\r\n<p>Pour le paiement, le RIB du club est tjs le m&ecirc;me:</p>\r\n<p>\r\n<div class=\\"msg-body inner  undoreset\\">\r\n<div id=\\"yiv678123633\\">\r\n<div>\r\n<div>\r\n<div>\r\n<div>SUC ULTIMATE</div>\r\n<div>Domiciliation: CCM STRASBOURG ROBERTSAU</div>\r\n<div>IBAN: FR76 1027 8010 0600 0255 8024&nbsp;549</div>\r\n<div>BIC: CMCIFR2A</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</p>', 1340056023, 29, 136),
(226, '<p>Vu l\\''heure matinale, partir vendredi soir m\\''arrange :)</p>\r\n<p>Par contre j\\''ai encore assez mal au aducteurs, j\\''esp&egrave;re que &ccedil;a va s\\''am&eacute;liorer d\\''ici vendredi :s</p>', 1340102977, 29, 130),
(227, 'Rolli, Gilles, je vous propose un rdv vendredi soir Ã  19h au stade U pour un dÃ©part vers 19h15, dites moi si Ã§a vous convient. (Gilles je ne connais pas tes horaires de boulot)\r\n\r\nTaner je n\\''ai pas eu de nouvelles de ta part mais si tu le souhaites tu es le bienvenu parmis nous pour le dÃ©part vendredi soir, j\\''ai encore de la place. Sinon vois avec Ben pour partir samedi.\r\n\r\nHugo', 1340173756, 29, 150),
(228, '<p>Ok Gilles, profitez bien de la welcome alors... mais trop quand m&ecirc;me, on vous veux en forme le samedi d&egrave;s 9h30.</p>', 1340212107, 29, 143),
(229, '<p>Nous 3 sesquis de la Sperrmull Cie (L&eacute;l&eacute;, Lolo et Tom) partirons le vendredi soir histoire de gagner d\\''entr&eacute;e de jeu la welcome, j\\''ai r&eacute;ussi &agrave; taxer la voiture de ma m&ocirc;man d&eacute;vou&eacute;e.&nbsp;</p>\r\n<p>Ce qui veut dire qu\\''il nous reste &eacute;ventuellement 1 place (et non pas 2 car ce n\\''est qu\\''une 206) pour un d&eacute;part le vendredi soir, si &ccedil;a interesse qqn. Attention il est notable de pr&eacute;ciser que nous serons vendredi soir &agrave; partir de 18h en mode \\"tr&egrave;s con\\" :)&nbsp;</p>\r\n<p>A plus :)&nbsp;</p>', 1340221395, 29, 119),
(230, '<p>changement de programe, je peux pas partir vendredi soir, est-ce qu\\''il reste une place samedi matin?</p>', 1340272457, 29, 130),
(231, '<p>news de derni&egrave;re minute, j\\''emm&egrave;ne Saskia d&egrave;s vendredi soir et participeront donc &agrave; la Welcome. Il faudra qu\\''on se mettent en mode tr&egrave;s con. Je briefferai Saskia l&agrave;-dessus ; )</p>\r\n<p>Fab</p>', 1340305616, 29, 136),
(232, 'Qqn a des news de Taner ?\r\n\r\nSinon oubliez pas vos gamelles pour manger !\r\n\r\n(au fait j\\''ai un sac de couchage et un matelas en rab que je peux emmener si il faut, quelqu\\''un en a besoin ?)', 1340308269, 29, 150),
(233, '<p>Bon we (sous le soleil de la Lorraine!) les Sesquis et Sesquis\\''mull !</p>', 1340345110, 29, 131),
(234, '<p>Gilles -&gt; Il reste de la place le samedi matin, tu es &eacute;videmment le bienvenue, d&eacute;part 6h30 de la place de Haguenau, file moi ton N&deg; de portable, on ne sait jamais (le mien : 0612300481)</p>\r\n<p>Emil -&gt; Merci &agrave; toi, bosse pas trop ce WE ;)</p>', 1340361670, 29, 143);

-- --------------------------------------------------------

--
-- Structure de la table `forum_scat`
--

CREATE TABLE IF NOT EXISTS `forum_scat` (
  `ID` int(11) NOT NULL auto_increment COMMENT 'identifiant de la sous-catégorie.',
  `LIBELLE` varchar(255) character set latin1 NOT NULL COMMENT 'titre de la sous-catégorie.',
  `RANG` int(11) NOT NULL COMMENT 'position de la liste lors de l''affichage.',
  `ID_CAT` int(11) NOT NULL COMMENT 'clef vers l''id primaire de la table catégorie',
  `DESC` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `ID_CAT` (`ID_CAT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant les sous-catégories.' AUTO_INCREMENT=47 ;

--
-- Contenu de la table `forum_scat`
--

INSERT INTO `forum_scat` (`ID`, `LIBELLE`, `RANG`, `ID_CAT`, `DESC`) VALUES
(37, 'Avant le départ ', 1, 31, '(Loc. minibus, Covoiturage, Résa du F1, Départ, Bierregel, Playlist, Fees,...) '),
(38, 'Après le retour', 2, 31, '(Frais de route, péage, lost and found, impressions, bisous,...)'),
(39, 'Coupe de l\\''Est 2011', 1, 32, 'Qui fait quoi ? '),
(41, 'Keep Your Mustache 2012 ', 2, 32, 'Qui fait quoi ? '),
(42, 'Les règles ', 1, 34, 'Analyse et débat sur le règlement '),
(43, 'Soirée(s)/Sortie(s)', 1, 33, 'Invite tes coéquipiers à partager des moments inoubliables...'),
(44, 'Lancer/courir en off', 2, 33, 'Marre de lancer et de courir tout seul, invite tes coéquipiers ! '),
(46, 'Tribune libre', 5, 33, 'Parlez de ce que vous voulez !!');

-- --------------------------------------------------------

--
-- Structure de la table `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
  `ID` int(11) NOT NULL auto_increment COMMENT 'identifiant du topic.',
  `LIBELLE` varchar(255) character set latin1 NOT NULL COMMENT 'titre du topic.',
  `ID_SCAT` int(11) NOT NULL COMMENT 'identifiant de la catégorie.',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `LIBELLE` (`LIBELLE`),
  KEY `ID_SCAT` (`ID_SCAT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant tous les topics de toutes les catégories.' AUTO_INCREMENT=30 ;

--
-- Contenu de la table `forum_topic`
--

INSERT INTO `forum_topic` (`ID`, `LIBELLE`, `ID_SCAT`) VALUES
(2, 'Sortie neige', 43),
(3, 'Contrepètrie pour Alban ', 46),
(4, 'Negociation avec la mairie ', 41),
(5, 'Resto du samedi soir ', 39),
(6, 'Disc golf un peu de spectacle', 44),
(7, 'Restaurant du 13/01/2012', 43),
(8, 'Buvette ', 39),
(9, 'C\\''est ton anniversaire !!', 43),
(10, '[MOLODOI] Soirée One Man Band', 43),
(13, 'SISTA', 38),
(14, 'COUPE DE L\\''EST à Reuss', 38),
(15, 'Week-end du 28-29 avril (+30 avril - 1er mai)', 37),
(16, '1997 ?', 46),
(17, 'goodies', 41),
(18, 'Consultation / Ecriture sur le site', 46),
(19, 'Equipes intéressés ', 41),
(20, 'N2', 38),
(21, 'PILSEN', 37),
(22, 'prepa physique ', 44),
(23, 'Play-off Blois', 37),
(24, 'lancer en touriste', 44),
(25, 'Phase aller Outdoor Besancon', 37),
(26, 'Covoiturage', 46),
(27, 'Listes des équipes retenues ', 41),
(28, 'TRAVEL', 42),
(29, 'Urban free\\''z\\''beach Vol. 4', 37);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id_image` int(11) NOT NULL auto_increment,
  `nom_image` varchar(100) NOT NULL,
  `link_picture` varchar(100) NOT NULL,
  `link_mini` varchar(100) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `description` text,
  `id_album` int(11) NOT NULL default '1',
  `slideshow` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id_image`),
  UNIQUE KEY `nom_image` (`nom_image`,`link_picture`,`link_mini`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=221 ;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id_image`, `nom_image`, `link_picture`, `link_mini`, `height`, `width`, `description`, `id_album`, `slideshow`) VALUES
(98, 'Ced et Didier contre les Crazy Dogs en finale.jpg', './picture/Ced et Didier contre les Crazy Dogs en f', './mini/Ced et Didier contre les Crazy Dogs en fina', 200, 300, NULL, 13, 0),
(99, 'Fabien D. la pause !.jpg', './picture/Fabien D. la pause !.jpg', './mini/Fabien D. la pause !.jpg', 534, 800, NULL, 13, 0),
(100, 'fin du tournoi aprÃ¨s la remise des prix.jpg', './picture/fin du tournoi aprÃ¨s la remise des prix', './mini/fin du tournoi aprÃ¨s la remise des prix.jp', 400, 600, NULL, 13, 0),
(101, 'Fin du we - groupe 1.jpg', './picture/Fin du we - groupe 1.jpg', './mini/Fin du we - groupe 1.jpg', 800, 534, NULL, 13, 0),
(102, 'Fin du we - groupe 2.jpg', './picture/Fin du we - groupe 2.jpg', './mini/Fin du we - groupe 2.jpg', 800, 534, NULL, 13, 0),
(103, 'Fin du we - groupe 3.jpg', './picture/Fin du we - groupe 3.jpg', './mini/Fin du we - groupe 3.jpg', 800, 532, NULL, 13, 0),
(104, 'groupe aprÃ¨s remise des prix.jpg', './picture/groupe aprÃ¨s remise des prix.jpg', './mini/groupe aprÃ¨s remise des prix.jpg', 534, 800, NULL, 13, 0),
(105, 'La finale - le temps mort.jpg', './picture/La finale - le temps mort.jpg', './mini/La finale - le temps mort.jpg', 534, 800, NULL, 13, 0),
(106, 'La finale ... Alban  F.jpg', './picture/La finale ... Alban  F.jpg', './mini/La finale ... Alban  F.jpg', 534, 800, NULL, 13, 0),
(107, 'La finale ... Alban F.jpg', './picture/La finale ... Alban F.jpg', './mini/La finale ... Alban F.jpg', 534, 800, NULL, 13, 0),
(108, 'La finale ... Didier P.jpg', './picture/La finale ... Didier P.jpg', './mini/La finale ... Didier P.jpg', 534, 800, NULL, 13, 0),
(109, 'La finale ... Jojo.jpg', './picture/La finale ... Jojo.jpg', './mini/La finale ... Jojo.jpg', 534, 800, NULL, 13, 0),
(110, 'La finale ... les Crazy Dogs.jpg', './picture/La finale ... les Crazy Dogs.jpg', './mini/La finale ... les Crazy Dogs.jpg', 534, 800, NULL, 13, 0),
(111, 'La finale ... Momo Ã  la table de marque.jpg', './picture/La finale ... Momo Ã  la table de marque', './mini/La finale ... Momo Ã  la table de marque.jp', 534, 800, NULL, 13, 0),
(112, 'La finale ... Nicolas I.jpg', './picture/La finale ... Nicolas I.jpg', './mini/La finale ... Nicolas I.jpg', 534, 800, NULL, 13, 0),
(113, 'La finale ... Nono.jpg', './picture/La finale ... Nono.jpg', './mini/La finale ... Nono.jpg', 800, 533, NULL, 13, 0),
(114, 'La finale ... StÃ©phane H.jpg', './picture/La finale ... StÃ©phane H.jpg', './mini/La finale ... StÃ©phane H.jpg', 534, 800, NULL, 13, 0),
(115, 'La remise des prix - le fair play.jpg', './picture/La remise des prix - le fair play.jpg', './mini/La remise des prix - le fair play.jpg', 532, 800, NULL, 13, 0),
(117, 'La remise des prix - les Crazy Dogs terminent 2Ã¨me.jpg', './picture/La remise des prix - les Crazy Dogs terminent 2Ã¨me.jpg', './mini/La remise des prix - les Crazy Dogs terminent 2Ã¨me.jpg', 800, 534, NULL, 13, 0),
(118, 'La remise des prix.jpg', './picture/La remise des prix.jpg', './mini/La remise des prix.jpg', 533, 800, NULL, 13, 0),
(119, 'La remise du trophÃ©e du fair-play.jpg', './picture/La remise du trophÃ©e du fair-play.jpg', './mini/La remise du trophÃ©e du fair-play.jpg', 534, 800, NULL, 13, 0),
(123, 'Lequipe des Sesquidistus remporte son propre tournoi !.jpg', './picture/Lequipe des Sesquidistus remporte son propre tournoi !.jpg', './mini/Lequipe des Sesquidistus remporte son propre tournoi !.jpg', 534, 800, NULL, 13, 0),
(124, 'Les finalistes Crazy Dogs finissent 2eme.jpg', './picture/Les finalistes Crazy Dogs finissent 2eme.jpg', './mini/Les finalistes Crazy Dogs finissent 2eme.jpg', 534, 800, NULL, 13, 0),
(126, 'Faulquemont_20090531_550.JPG', './picture/Faulquemont_20090531_550.JPG', './mini/Faulquemont_20090531_550.JPG', 2304, 3456, 'L''Ã©quipe de dingues', 15, 0),
(148, 'keep your musatche bleu.png', './picture/keep your musatche bleu.png', './mini/keep your musatche bleu.png', 224, 579, NULL, 41, 0),
(149, 'affiche keep your mustache.PNG', './picture/affiche keep your mustache.PNG', './mini/affiche keep your mustache.PNG', 1053, 745, 'Affiche KEEP YOUR MUSTACHE', 41, 0),
(150, 'Missuldsic LowR 2.jpg', './picture/Missuldsic LowR 2.jpg', './mini/Missuldsic LowR 2.jpg', 1500, 2000, 'Missuldisc 2011', 40, 0),
(151, 'IMG_5145.jpg', './picture/IMG_5145.jpg', './mini/IMG_5145.jpg', 1944, 2592, 'Equipe du weekend', 40, 0),
(152, 'IMG_5150.jpg', './picture/IMG_5150.jpg', './mini/IMG_5150.jpg', 1944, 2592, 'pyramide', 36, 0),
(153, 'NJ031688.JPG', './picture/NJ031688.JPG', './mini/NJ031688.JPG', 1200, 1600, NULL, 36, 0),
(154, 'NJ031659.JPG', './picture/NJ031659.JPG', './mini/NJ031659.JPG', 1200, 1600, NULL, 36, 0),
(155, 'NJ031668.JPG', './picture/NJ031668.JPG', './mini/NJ031668.JPG', 1200, 1600, NULL, 36, 0),
(156, 'NJ031673.JPG', './picture/NJ031673.JPG', './mini/NJ031673.JPG', 1200, 1600, NULL, 36, 0),
(157, 'NJ031683.JPG', './picture/NJ031683.JPG', './mini/NJ031683.JPG', 1200, 1600, NULL, 36, 0),
(158, 'NJ031849.JPG', './picture/NJ031849.JPG', './mini/NJ031849.JPG', 1200, 1600, NULL, 36, 0),
(159, 'IMG_5160.JPG', './picture/IMG_5160.JPG', './mini/IMG_5160.JPG', 515, 800, NULL, 40, 0),
(161, 'IMG_0110.jpg', './picture/IMG_0110.jpg', './mini/IMG_0110.jpg', 2592, 1944, NULL, 39, 0),
(162, 'seven savage.jpg', './picture/seven savage.jpg', './mini/seven savage.jpg', 600, 800, NULL, 40, 0),
(163, 'P1000515(1).JPG', './picture/P1000515(1).JPG', './mini/P1000515(1).JPG', 3240, 4320, 'milan 2011', 40, 0),
(164, 'madunina2011_003.jpg', './picture/madunina2011_003.jpg', './mini/madunina2011_003.jpg', 480, 720, 'milan 2011', 40, 0),
(165, 'Ã©quipe mixte Blois 2011.JPG', './picture/Ã©quipe mixte Blois 2011.JPG', './mini/Ã©quipe mixte Blois 2011.JPG', 2448, 3264, NULL, 40, 0),
(166, 'vesoul 2011.jpg', './picture/vesoul 2011.jpg', './mini/vesoul 2011.jpg', 960, 720, NULL, 40, 0),
(167, 'N2 INDOOR NEMOURS_20111030_42.JPG', './picture/N2 INDOOR NEMOURS_20111030_42.JPG', './mini/N2 INDOOR NEMOURS_20111030_42.JPG', 2304, 3456, NULL, 40, 0),
(168, 'DR1 INDOOR BESANCON 2011-2012 Aller.JPG', './picture/DR1 INDOOR BESANCON 2011-2012 Aller.JPG', './mini/DR1 INDOOR BESANCON 2011-2012 Aller.JPG', 2304, 3456, NULL, 40, 0),
(169, 'DR2 Faulquemont 2011.jpg', './picture/DR2 Faulquemont 2011.jpg', './mini/DR2 Faulquemont 2011.jpg', 720, 960, NULL, 40, 0),
(170, 'Allemand 2 Mustache.jpg', './picture/Allemand 2 Mustache.jpg', './mini/Allemand 2 Mustache.jpg', 482, 720, NULL, 41, 0),
(171, 'Allemand Mustache.jpg', './picture/Allemand Mustache.jpg', './mini/Allemand Mustache.jpg', 482, 720, NULL, 41, 0),
(172, 'Bab Mustache.jpg', './picture/Bab Mustache.jpg', './mini/Bab Mustache.jpg', 720, 586, NULL, 41, 0),
(173, 'Gilles Mustache.jpg', './picture/Gilles Mustache.jpg', './mini/Gilles Mustache.jpg', 482, 720, NULL, 41, 0),
(174, 'Jafou Mustache.jpg', './picture/Jafou Mustache.jpg', './mini/Jafou Mustache.jpg', 720, 649, NULL, 41, 0),
(175, 'Kelly Mustache.jpg', './picture/Kelly Mustache.jpg', './mini/Kelly Mustache.jpg', 720, 540, NULL, 41, 0),
(176, 'Meryl DÃ©fence de Zone.jpg', './picture/Meryl DÃ©fence de Zone.jpg', './mini/Meryl DÃ©fence de Zone.jpg', 482, 720, NULL, 41, 0),
(177, 'Taner Mustache.jpg', './picture/Taner Mustache.jpg', './mini/Taner Mustache.jpg', 720, 482, NULL, 41, 0),
(178, 'Thibaut Mustache.jpg', './picture/Thibaut Mustache.jpg', './mini/Thibaut Mustache.jpg', 482, 720, NULL, 41, 0),
(179, 'Thomas K Mustache.jpg', './picture/Thomas K Mustache.jpg', './mini/Thomas K Mustache.jpg', 676, 720, NULL, 41, 0),
(180, 'Tom Mustache.jpg', './picture/Tom Mustache.jpg', './mini/Tom Mustache.jpg', 720, 482, NULL, 41, 0),
(181, '13035_1205349827873_1652472819_30531034_8381316_n.jpg', './picture/13035_1205349827873_1652472819_30531034_8381316_n.jpg', './mini/13035_1205349827873_1652472819_30531034_8381316_n.jpg', 529, 604, 'Sesqui DIX Tournament saverne 2008', 42, 0),
(182, '13035_1205349907875_1652472819_30531036_803572_n.jpg', './picture/13035_1205349907875_1652472819_30531036_803572_n.jpg', './mini/13035_1205349907875_1652472819_30531036_803572_n.jpg', 256, 604, 'Sesqui DIX Tournament saverne 2008', 42, 0),
(183, '13035_1205350427888_1652472819_30531045_6919088_n.jpg', './picture/13035_1205350427888_1652472819_30531045_6919088_n.jpg', './mini/13035_1205350427888_1652472819_30531045_6919088_n.jpg', 479, 604, 'Sesqui DIX Tournament saverne 2008', 42, 0),
(185, '13035_1205352147931_1652472819_30531062_2832064_n.jpg', './picture/13035_1205352147931_1652472819_30531062_2832064_n.jpg', './mini/13035_1205352147931_1652472819_30531062_2832064_n.jpg', 453, 604, 'Sesqui DIX Tournament saverne 2008', 42, 0),
(186, '13035_1205352387937_1652472819_30531065_2536819_n.jpg', './picture/13035_1205352387937_1652472819_30531065_2536819_n.jpg', './mini/13035_1205352387937_1652472819_30531065_2536819_n.jpg', 453, 604, 'Sesqui DIX Tournament saverne 2008', 42, 0),
(187, '13035_1205352547941_1652472819_30531068_2482916_n.jpg', './picture/13035_1205352547941_1652472819_30531068_2482916_n.jpg', './mini/13035_1205352547941_1652472819_30531068_2482916_n.jpg', 453, 604, 'Sesqui DIX Tournament saverne 2008', 42, 0),
(188, 'ronde sesquis faulquemont.jpg', './picture/ronde sesquis faulquemont.jpg', './mini/ronde sesquis faulquemont.jpg', 123, 433, NULL, 43, 0),
(190, 'Ã©quipe mixte Blois.JPG', './picture/Ã©quipe mixte Blois.JPG', './mini/Ã©quipe mixte Blois.JPG', 929, 3264, NULL, 43, 0),
(195, 'Photo Beckum.jpg', './picture/Photo Beckum.jpg', './mini/Photo Beckum.jpg', 717, 960, NULL, 40, 0),
(196, 'photo old school.jpg', './picture/photo old school.jpg', './mini/photo old school.jpg', 258, 904, NULL, 43, 0),
(197, 'Drapeau Bleu.jpg', './picture/Drapeau Bleu.jpg', './mini/Drapeau Bleu.jpg', 158, 552, NULL, 43, 0),
(198, 'logo-ffdf.jpg', './picture/logo-ffdf.jpg', './mini/logo-ffdf.jpg', 144, 160, NULL, 43, 0),
(199, 'Logo Sesquiditus - Final (1).jpg', './picture/Logo Sesquiditus - Final (1).jpg', './mini/Logo Sesquiditus - Final (1).jpg', 1196, 1194, NULL, 43, 0),
(210, 'Claire Puc.jpg', './picture/Claire Puc.jpg', './mini/Claire Puc.jpg', 682, 1024, NULL, 45, 0),
(211, 'Ouist Terrible Mokey.jpg', './picture/Ouist Terrible Mokey.jpg', './mini/Ouist Terrible Mokey.jpg', 480, 720, NULL, 45, 0),
(212, 'Ronde Puc.jpg', './picture/Ronde Puc.jpg', './mini/Ronde Puc.jpg', 683, 1024, NULL, 45, 0),
(213, 'N2 INDOOR NEMOURS_20111030_67.JPG', './picture/N2 INDOOR NEMOURS_20111030_67.JPG', './mini/N2 INDOOR NEMOURS_20111030_67.JPG', 2304, 3456, 'N2 indoor Nemours 2011-12 Aller', 40, 0),
(214, 'sesqui.jpg', './picture/sesqui.jpg', './mini/sesqui.jpg', 540, 720, 'Constance 2011 - 8e/12', 40, 0),
(215, 'Logo Casquettes et Autocollants.png', './picture/Logo Casquettes et Autocollants.png', './mini/Logo Casquettes et Autocollants.png', 230, 540, NULL, 46, 0),
(218, '444.jpg', './picture/444.jpg', './mini/444.jpg', 400, 394, 'AndrÃ©', 46, 0),
(219, 'ichbineinmustacher_design.jpg', './picture/ichbineinmustacher_design.jpg', './mini/ichbineinmustacher_design.jpg', 340, 340, 'jfk', 46, 0),
(220, 'lena.jpg', './picture/lena.jpg', './mini/lena.jpg', 512, 512, 'Test Etienne', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `inscription_tournoi`
--

CREATE TABLE IF NOT EXISTS `inscription_tournoi` (
  `id_formulaire` int(11) NOT NULL auto_increment,
  `id_event` int(11) NOT NULL,
  `questions` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_formulaire`),
  KEY `id_event` (`id_event`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `inscription_tournoi`
--

INSERT INTO `inscription_tournoi` (`id_formulaire`, `id_event`, `questions`, `date`) VALUES
(11, 201, 'Nom de votre équipe :~Quand arrivez-vous ? (jour et heure approximative)~Combien de joueurs êtes-vous ?~Combien d''accompagnateurs ? Enfants, adultes ?~Nombre de végétariens ?~Quelle formule choisissez-vous ?~Le mail et le n° de tel de votre contact équipe :', '2011-05-06');

-- --------------------------------------------------------

--
-- Structure de la table `lieu_ultimate`
--

CREATE TABLE IF NOT EXISTS `lieu_ultimate` (
  `numero` int(11) NOT NULL auto_increment,
  `nom` text NOT NULL,
  `adresse` text NOT NULL,
  PRIMARY KEY  (`numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `lieu_ultimate`
--

INSERT INTO `lieu_ultimate` (`numero`, `nom`, `adresse`) VALUES
(1, 'Stade Universitaire', '5 Rue Fritz Kieffer, Strasbourg'),
(2, 'Centre Sportif de l''Esplanade', '15 Rue Louvois, Strasbourg');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `ID` int(11) NOT NULL auto_increment,
  `LOGIN` varchar(25) character set latin1 NOT NULL,
  `PASSWD` varchar(255) character set latin1 NOT NULL,
  `ADMIN` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `LOGIN` (`LOGIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant tous les membres.' AUTO_INCREMENT=164 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`ID`, `LOGIN`, `PASSWD`, `ADMIN`) VALUES
(99, 'admin', '69157992ae5d4df754044c60f6df3f1b', 1),
(100, 'toutouille', '69157992ae5d4df754044c60f6df3f1b', 0),
(114, 'laureni', '43fb47643615dac42b226ff273caa084', 1),
(116, 'pepite', 'd8934ab45f52a56402bbc5c81b90a6bc', 0),
(117, 'Taner', 'b4f9fe8621bb366944ade7b70d8658c3', 0),
(118, 'thibaut thibaut', 'a6093c6f0c56edd55e1588b110291ac1', 0),
(119, 'Tom', '1518f02e64813af630ed93a590f3c1af', 0),
(120, 'Ced', '14bf242260cfec48df8a14fa1fdbbcf9', 1),
(121, 'niko_with_you', 'e5481129c14706c0da4cedf9fe790fa4', 0),
(122, 'wlada', '5364d16374c002605201574acb622203', 0),
(123, 'Ouistiti', '5166da5b859c2d88d9ba7215361a773c', 0),
(129, 'Froggy', '1ba3ee6c89f635c1742c3e95688f88b6', 0),
(130, 'Pepe`', '813808b75410ddf4aa8fff7d8b29179f', 0),
(131, 'Emil', 'fb6659a92ea0c98845f45e697b7457af', 0),
(132, 'P-A', '182f2da72923073c297e82f1599af5e3', 0),
(133, 'kOftE', '0a7eb7cc70877c304185b8148f07d084', 0),
(134, 'Nono', '36e7507a860d13b715a28b0a42866089', 0),
(135, 'Arca13', 'd4652604751e08799a4f0054a4dfa261', 0),
(136, 'Fabes', 'b61b1ec7995236bc1e8a672c3d53ac68', 0),
(137, 'Poups', 'deb3619dbd17ce95555b1ee71e667f27', 0),
(138, 'Xavier', '419d59b927ba3d02503ff5bfdb0a7fda', 0),
(139, 'Marion', '8d2585498068ba88c769b40d9753676f', 0),
(140, 'Roli', 'b7bbf94579a88920a2f8f0fbd11e4457', 0),
(141, 'Julien', 'f7df5ad1a1c1a40fa4812b82f6cb0a51', 0),
(142, 'scoubi99', 'd8be4c8134966be2617254b5b648545d', 0),
(143, 'BenoÃ®t', '628574cc0fd4dc30762deb44049a62a0', 0),
(145, 'Ganesh', 'e86ac69b697fcabe2c829818d4ec57fe', 0),
(146, 'StÃ©pheee', '43169d46731e0b9066a7965f12644bdc', 0),
(147, 'Titi', '9ea944602ce3bde2ef9ea3c6df13e8b5', 1),
(148, 'LÃ©lÃ©', '2a56c9db859473f59a8756b04331117b', 0),
(149, 'Saskia', '7501354ed06c453630525febb233190f', 0),
(150, 'Hugo', 'fc123253dddf3e2d003a48b459934182', 0),
(151, 'Lucile', '9661e4802e266c26dc9167f3dd8029a0', 0),
(152, 'Julietchka', '47b27e790336fcc8c322e738317309cc', 0),
(153, 'lea.gisquet', '68cffabf19af13a77a6d933da018e505', 0),
(154, 'PointG', 'a0ea6fdfa7e7d74feab071c16b46acda', 0),
(155, 'Fannie', '332e8467a9229b1cef3a5e98949f7844', 0),
(156, 'Marianne', '1b4348622d30963e58287ac47ce0b973', 0),
(157, 'greg', '6d9b63a9addfe90d0f551a2c7bce9f5d', 0),
(158, 'donut', 'f639058b91ca101b20d4bb847cb2257c', 0),
(159, 'Toony', '9bb3c76dc398454a5d2990ee89c9e3f9', 0),
(160, 'Yoann', '6e7275b84f2144c96d771df2977c20ff', 0),
(161, 'kelly', 'a80be8e2da2bf617431b86188e4e97a3', 0),
(162, 'Dudu', '3600db328c56761a9aad61e5fdda652a', 0),
(163, 'godeleers', '24bd3e4550eeb7b70a5fb930db4509ec', 0);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `ID` int(4) NOT NULL auto_increment,
  `ID_MEMBRE` int(4) NOT NULL COMMENT 'Clef étrangère vers la table membre',
  `NOM` varchar(50) NOT NULL COMMENT 'Nom du joueur',
  `PRENOM` varchar(50) NOT NULL COMMENT 'Prénom du joueur',
  `MAIL` varchar(100) NOT NULL COMMENT 'Adresse mail',
  `MAIN` varchar(8) NOT NULL COMMENT 'Gaucher ou droitier',
  `POSTE` varchar(50) NOT NULL COMMENT 'poste occupé',
  `COUP` varchar(50) NOT NULL COMMENT 'coup préféré',
  `ADHESION` date NOT NULL COMMENT 'Date d''adhésion au club',
  `SOUVENIR` text NOT NULL COMMENT 'Meilleur souvenir',
  `POURQUOI` text NOT NULL COMMENT 'Pourqui l''ultimate',
  `AVATAR` tinytext NOT NULL,
  `AVATAR_MIN` tinytext NOT NULL,
  `QUESTION` varchar(100) NOT NULL COMMENT 'Question secrète',
  `REPONSE` varchar(100) NOT NULL COMMENT 'Réponse à la question secrète',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID_MEMBRE` (`ID_MEMBRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations sur les membres.' AUTO_INCREMENT=136 ;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`ID`, `ID_MEMBRE`, `NOM`, `PRENOM`, `MAIL`, `MAIN`, `POSTE`, `COUP`, `ADHESION`, `SOUVENIR`, `POURQUOI`, `AVATAR`, `AVATAR_MIN`, `QUESTION`, `REPONSE`) VALUES
(76, 99, 'Foulonneau', 'Alban', 'alban.foulonneau@uha.fr', 'Droitier', 'Entraineur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'nantes'),
(77, 100, 'Foulonneau', 'Alban', 'alban.foulonneau@uha.fr', 'Droitier', 'Entraineur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'nantes'),
(86, 114, 'Laureni #05', 'Leipelt Laurent', 'laurent.leipelt@gmail.com', 'Droitier', 'Lanceur', 'La fusée magique', '2008-01-01', 'DR Retour Faulquemont 2011.', 'parce que lélé voulait en faire !', './modules/membres/avatar/laureni.jpg', './modules/membres/mini_avatar/mini_laureni.jpg', 'Quel est votre lieu de naissance ?', 'thann'),
(88, 116, 'Claire #06', 'Samsel Claire', 'claire.samsel@wanadoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2000-01-01', 'La montée (ou le maintien maintenant je sais plus) en N2, retour en TGV de Nantes alors qu\\''on avait joué qu\\''à 7 ou 8 joueurs. Année ? demanderz à Alban  pour l\\''ann', 'Parce que c\\''est fair-play, mixte, et ouvert à tous.', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre film prÃ©fÃ©rÃ© ?', 'Pour le pire et pour le meilleur'),
(89, 117, 'Taner #02', 'Kos Taner', 'taner.kos@hotmail.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2010-01-01', '', '', './modules/membres/avatar/Taner.jpg', './modules/membres/mini_avatar/mini_Taner.jpg', 'Quel est le nom de votre professeur prÃ©fÃ©rÃ© ?', 'Crombez'),
(90, 118, 'Chocapic #07', 'UhlenThibaut', 'thibaut0901@hotmail.fr', 'Droitier', 'Lanceur', 'La galette fusil', '2009-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre film prÃ©fÃ©rÃ© ?', 'Quoi'),
(91, 119, 'Tom #08', 'Graff Thomas', 'graff.tom@hotmail.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/Tom.jpg', './modules/membres/mini_avatar/mini_Tom.jpg', 'Quel est votre lieu de naissance ?', 'strasbourg'),
(92, 120, 'Ced #23', 'Ced #23', 'cedw@wanadoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/Ced.jpg', './modules/membres/mini_avatar/mini_Ced.jpg', 'Quel est le nom de votre animal de compagnie ?', 'pepsi'),
(93, 121, 'Niko\\'' #29', 'Merstorf Nicolas', 'nmerstorf@gmail.com', 'Droitier', 'Lanceur', 'La galette fusil', '2010-01-01', 'D-dive!', 'parce que c\\''est trop cool', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est le nom de votre animal de compagnie ?', 'ChloÃ©'),
(94, 122, 'Wlada K. #39', 'Kusbach Vlada', 'kusbach@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/wlada.jpg', './modules/membres/mini_avatar/mini_wlada.jpg', 'Quel est votre lieu de naissance ?', 'aflkhsnld'),
(95, 123, 'Ouistiti #112', 'Nicolas', 'ouistitinico@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2005-01-01', 'coupe de l\\''Est indoor à la maison vs Everest\r\nun match de folie :)\r\non termine 2ème + spirit  :)', '', './modules/membres/avatar/Ouistiti.png', './modules/membres/mini_avatar/mini_Ouistiti.png', 'Quel est votre lieu de naissance ?', 'berlin'),
(101, 129, 'Froggy #11', 'Gautherie Aurélien', 'agautherie@yahoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2008-01-01', '', 'Pour la défense et les croûtes ! ', './modules/membres/avatar/Froggy.jpg', './modules/membres/mini_avatar/mini_Froggy.jpg', 'Quel est votre lieu de naissance ?', 'Schiltigheim'),
(102, 130, 'Pepe`  #00', 'Bourguignat Gilles', 'trafpepe@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2010-01-01', '', '', './modules/membres/avatar/Pepe`.jpg', './modules/membres/mini_avatar/mini_Pepe`.jpg', 'Quel est le nom de votre animal de compagnie ?', 'twix'),
(103, 131, 'Ductile #82', 'Emil', '', 'Droitier', 'Lanceur', 'La fusée magique', '2011-01-01', 'Tsunamixte 2010', 'parce que Souki !', './modules/membres/avatar/Emil.jpg', './modules/membres/mini_avatar/mini_Emil.jpg', 'Quel est votre lieu de naissance ?', 'Epinal'),
(104, 132, 'P-A #16', 'Pierre-Alexandre Monet', 'pierrealexandremonet@yahoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'BesanÃ§on'),
(105, 133, 'Max #??', 'Fontaine Maximilien', 'fontaine.maximilien@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre film prÃ©fÃ©rÃ© ?', 'Dikkenek'),
(106, 134, 'Nono #13', 'Vanheuverswyn Arnaud', 'arnaud.vanheuverswyn@netcourrier.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2007-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est le nom de votre animal de compagnie ?', 'agathe'),
(107, 135, 'Jean-Louis #??', 'Albertini Jean-louis', 'arcanium013@hotmail.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre film prÃ©fÃ©rÃ© ?', 'superman'),
(108, 136, 'Fab #80', 'Dumay Fabien', 'fabien.dumay@yahoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', 'A chaque fois que je monte sur le terrain, c\\''est le plus beau jour de ma vie. Chaque souvenir est un meilleur souvenir.', 'Parce qu\\''un autre monde est possible\r\n', './modules/membres/avatar/Fabes.jpg', './modules/membres/mini_avatar/mini_Fabes.jpg', 'Quel est votre film prÃ©fÃ©rÃ© ?', 'H2G2'),
(109, 137, 'Poupinette #20', 'VIRVOULET Anne-Laure', 'alevi2002@hotmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2010-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'Luxeuil les bains'),
(110, 138, 'Xavier #??', 'Dumas Xavier', 'xavier.dumas@insa-strasbourg.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'st die'),
(111, 139, 'Marion #??', 'Senjean Marion', 'msenjean@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/Marion.jpg', './modules/membres/mini_avatar/mini_Marion.jpg', 'Quel est le nom de votre animal de compagnie ?', 'michka'),
(112, 140, 'Roli #21', 'Graf Roli', 'graf.roland.00@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est le nom de votre animal de compagnie ?', 'Jade'),
(113, 141, 'Ju #49', 'Prinet Julien ', 'julien.prinet@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2009-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'CHOLET'),
(114, 142, 'Scoubi #99', 'Jaegert Nicolas', 'nicolastik@yahoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'colmar'),
(115, 143, 'Ben #25', 'Ecosse Benoit', 'ecosse_benoit@yahoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2009-01-01', 'Jouer les Troopers.', 'Quelle question ! C\\''est l\\''ultimate ou rien !', './modules/membres/avatar/BenoÃ®t.jpg', './modules/membres/mini_avatar/mini_BenoÃ®t.jpg', 'Quel est votre film prÃ©fÃ©rÃ© ?', '2001'),
(117, 145, 'Ganesh #33', 'Baudrier Etienne', 'etienb@yahoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'Tours'),
(118, 146, 'Stephe #78', 'Haessig Stéphanie', 'stephanie.haessig@laposte.net', 'Droitier', 'Lanceur', 'Lancé éclair', '2007-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'charenton le pont'),
(119, 147, '', 'Titi #95', 'titizebioutifoul@free.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2010-01-01', '', '', './modules/membres/avatar/Titi.jpg', './modules/membres/mini_avatar/mini_Titi.jpg', 'Quel est votre lieu de naissance ?', 'Strasbourg'),
(120, 148, 'Lele #03', 'Holstein Laetitia', 'holstein.laetitia@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2009-01-01', '', '', './modules/membres/avatar/LÃ©lÃ©.jpg', './modules/membres/mini_avatar/mini_LÃ©lÃ©.jpg', 'Quel est votre lieu de naissance ?', 'Mulhouse'),
(121, 149, 'Saskia #36', 'Biebert Saskia', 'sbiebert@web.de', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'KÃ¶ln'),
(122, 150, 'Hugo #28', 'Hugo', 'v-mh@hotmail.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', 'Parce que j\\''aime la galette !', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'Strasbourg'),
(123, 151, 'Lulu #14', 'Margraff Lucile', 'lucile.margraff@hotmail.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-01-01', '', 'Parce qu\\''on voulait faire du sport avec Lélé et qu\\''elle a dit \\" Ultimate?\\" ', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est le nom de votre animal de compagnie ?', 'DorÃ©mi'),
(124, 152, 'Julia #68', 'Julia', 'julia.reth@gmx.de', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est le nom de votre animal de compagnie ?', 'Mischka'),
(125, 153, 'Léa #26', 'Gisquet Lea', 'lea.gisquet@hotmail.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est le nom de votre animal de compagnie ?', 'milka'),
(126, 154, 'Gé #69', 'Bernard Jerome', 'Monsieurbernard@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-01-01', 'Peut-être bien le catch sur la photo ! Mais franchement, il y en a beaucoup beaucoup !', 'T\\''as déjà fait un beach ultimate mixte ? Crois moi, tu comprendras pourquoi :D', './modules/membres/avatar/PointG.jpg', './modules/membres/mini_avatar/mini_PointG.jpg', 'Quel est votre lieu de naissance ?', 'Strasbourg'),
(127, 155, 'Fannie #72', 'Lavoue Fannie', 'fannielavoue@hotmail.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-01-01', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'le mans'),
(128, 156, 'Marianne #83', 'Crevon Marianne', 'marianne.helene@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2011-01-01', '', '', './modules/membres/avatar/Marianne.jpg', './modules/membres/mini_avatar/mini_Marianne.jpg', 'Quel est votre lieu de naissance ?', 'oullins'),
(129, 157, 'SCHUBNEL', 'gregory', 'gregstore@yahoo.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-01-23', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'colmar'),
(130, 158, 'BUTEAU', 'Donatien', 'donatien.buteau@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-01-24', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'blois'),
(131, 159, 'Toony #55', 'Denis Frath', 'defrath@gmail.com', 'Droitier', 'Lanceur', 'La fusée magique', '2009-01-01', '', '', './modules/membres/avatar/Toony.jpg', './modules/membres/mini_avatar/mini_Toony.jpg', 'Quel est votre lieu de naissance ?', 'Brive'),
(132, 160, 'Desgrange', 'Yoann', 'yoann.desgrange@orange.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-01-27', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'Mulhouse'),
(133, 161, 'schwanke', 'kelly', 'kellys_67@hotmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-02-15', '', '', './modules/membres/avatar/kelly.png', './modules/membres/mini_avatar/mini_kelly.png', 'Quel est votre lieu de naissance ?', 'schiltigheim'),
(134, 162, 'Antoine', 'CÃ©line', 'antoine-cel@hotmail.fr', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-02-16', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est le nom de votre animal de compagnie ?', 'Leila'),
(135, 163, 'DELEERSNYDER', 'Godefroy', 'godeleers@gmail.com', 'Droitier', 'Lanceur', 'Lancé éclair', '2012-02-21', '', '', './modules/membres/avatar/no_avatar.png', './modules/membres/mini_avatar/mini_no_avatar.jpg', 'Quel est votre lieu de naissance ?', 'thionville');

-- --------------------------------------------------------

--
-- Structure de la table `reponse_inscription_tournoi`
--

CREATE TABLE IF NOT EXISTS `reponse_inscription_tournoi` (
  `id_reponse` int(11) NOT NULL auto_increment,
  `id_formulaire` int(11) NOT NULL,
  `questions` text NOT NULL,
  `reponses` text NOT NULL,
  `date` date NOT NULL,
  `lu` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id_reponse`),
  KEY `id_formulaire` (`id_formulaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `reponse_inscription_tournoi`
--

INSERT INTO `reponse_inscription_tournoi` (`id_reponse`, `id_formulaire`, `questions`, `reponses`, `date`, `lu`) VALUES
(4, 11, 'Nom de votre équipe :~Quand arrivez-vous ? (jour et heure approximative)~Combien de joueurs êtes-vous ?~Combien d''accompagnateurs ? Enfants, adultes ?~Nombre de végétariens ?~Quelle formule choisissez-vous ?~Le mail et le n° de tel de votre contact équipe :', 'test ~t ~ t~t~t~t~qui recoit ce mail ?  est ceq u''on valid ele truc ?', '2011-05-06', 1),
(5, 11, 'Nom de votre Ã©quipe :~Quand arrivez-vous ? (jour et heure approximative)~Combien de joueurs Ãªtes-vous ?~Combien d''accompagnateurs ? Enfants, adultes ?~Nombre de vÃ©gÃ©tariens ?~Quelle formule choisissez-vous ?~Le mail et le nÂ° de tel de votre contact Ã©quipe :', '', '2011-07-02', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponse_sondage`
--

CREATE TABLE IF NOT EXISTS `reponse_sondage` (
  `id_reponse` int(11) NOT NULL auto_increment,
  `id_sondage` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `reponse` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_reponse`),
  KEY `id_sondage` (`id_sondage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

CREATE TABLE IF NOT EXISTS `sondage` (
  `id_formulaire` int(11) NOT NULL auto_increment,
  `question` text NOT NULL,
  `reponse_possible` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_formulaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_event`
--

CREATE TABLE IF NOT EXISTS `type_event` (
  `numero` int(11) NOT NULL auto_increment,
  `nom` text NOT NULL,
  `color` tinytext NOT NULL,
  PRIMARY KEY  (`numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `type_event`
--

INSERT INTO `type_event` (`numero`, `nom`, `color`) VALUES
(1, 'Entrainement', '#274d94'),
(2, 'Divers', '#d8622f'),
(3, 'Reunion', '#87278b'),
(4, 'Tournoi externe au club', '#0d973a'),
(5, 'Tournoi organisé par le club', '#c20d0d'),
(11, 'Championnat FFDF', '#993366');

-- --------------------------------------------------------

--
-- Structure de la table `ultimate`
--

CREATE TABLE IF NOT EXISTS `ultimate` (
  `id` tinyint(4) NOT NULL auto_increment COMMENT 'id de la catégorie',
  `titre` varchar(50) NOT NULL COMMENT 'titre',
  `contenu` text NOT NULL COMMENT 'contenu',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `titre` (`titre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table contenant toutes les informations du module club' AUTO_INCREMENT=7 ;

--
-- Contenu de la table `ultimate`
--

INSERT INTO `ultimate` (`id`, `titre`, `contenu`) VALUES
(1, 'Histoire de Frisbee', '<h4><span style="font-size: small;">Un peu d''histoire</span></h4>\r\n<p><span style="font-size: small;"><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/Drapeau%20Bleu.jpg" alt="" width="470" height="135" /><br /></span></p>\r\n<p style="text-align: justify;"><span style="font-size: small;">Le principe du frisbee &eacute;tait connu bien avant son invention &laquo; officielle &raquo; en 1948. C''est justement en observant des &eacute;tudiants s''amuser &agrave; se lancer des moules &agrave; tartes de la Frisbie Pie Company que Walter Frederick Morrison, aid&eacute; et financ&eacute; par Warren Franscioni, eut l''id&eacute;e de fabriquer des disques en bak&eacute;lite qu''il baptisa &laquo; Flying-Saucer &raquo;. La compagnie Wham-O lui racheta son id&eacute;e en 1957 et commercialisa le &laquo; Pluto Platter &raquo;, renomm&eacute; un an plus tard &laquo; Frisbee &raquo;, une r&eacute;f&eacute;rence &agrave; peine voil&eacute;e &agrave; la Frisbie Pie Company qui avait inspir&eacute; la cr&eacute;ation du jouet.</span></p>\r\n<p style="text-align: justify;"><span style="font-size: x-small;"><em>Source : Site de la <a title="ffdf" href="http://www.ffdf.fr/La-FFDF/Histoire-de-Frisbee">ffdf</a></em></span></p>'),
(3, 'Histoire d''Ultimate', '<p><span style="font-size: small;"><strong>Les dates &agrave; retenir ...</strong></span></p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="modules/galerie/picture/photo%20old%20school.jpg" alt="" width="470" height="134" /></p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1869</strong></em>&nbsp;: Dans le&nbsp;Connecticut, au nord-est des &Eacute;tats-Unis, William Russel Frisbie cr&eacute;e une boulangerie industrielle appel&eacute;e la &laquo;&nbsp;Frisbie Pie Company&raquo;.</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1940</strong></em>&nbsp;: Des &eacute;tudiants du campus de&nbsp;Yale&nbsp;finissent leur repas en lan&ccedil;ant des moules &agrave; tartes de la &laquo;&nbsp;Frisbie Pie Company&nbsp;&raquo;, fournisseur officiel de l&rsquo;universit&eacute;.</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1948</strong></em>&nbsp;: Apr&egrave;s la Seconde Guerre mondiale, l&rsquo;Am&eacute;rique entre dans l&rsquo;&egrave;re du plastique. Fred Morrisson se souvient des parties de &laquo;&nbsp;moules &agrave; tartes&nbsp;&raquo; et met au point le premier disque volant. La soci&eacute;t&eacute; californienne de jeux Wham-o rach&egrave;te les droits et commercialise les disques sous le nom d&eacute;pos&eacute; de &laquo;&nbsp;Frisbee&nbsp;&raquo;.</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1960</strong></em>&nbsp;: Le&nbsp;Frisbee&nbsp;de comp&eacute;tition est n&eacute;. La soci&eacute;t&eacute; Wham-o cr&eacute;e l&rsquo;Association Internationale de&nbsp;Frisbee. D&rsquo;un simple jeu, le&nbsp;Frisbee&nbsp;est devenu un sport &agrave; part enti&egrave;re, avec ses r&egrave;gles, ses clubs, ses comp&eacute;titions.</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1967</strong></em>&nbsp;: Apparition de l&rsquo;ultimate&nbsp;d&eacute;velopp&eacute; par les &eacute;l&egrave;ves de la Columbia High School &agrave;&nbsp;Maplewood&nbsp;dans le&nbsp;New Jersey. Leur objectif est de cr&eacute;er un sport nouveau se r&eacute;f&eacute;rant aux valeurs originelles de l&rsquo;olympisme.</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1977</strong></em>&nbsp;: Introduction des sports de disque en&nbsp;Belgique&nbsp;(Jacques Thibaut) et en&nbsp;France.</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1978</strong></em>&nbsp;: Cr&eacute;ation du premier club belge d''ultimate: XLR8RS - Ixelles Air Raiders - Ultimate Brussels Frisbee Club</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1980</strong></em>&nbsp;: Cr&eacute;ation du premier club fran&ccedil;ais d''ultimate&nbsp;: le HOT</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1981</strong></em>&nbsp;: Organisation pour la premi&egrave;re fois en France d&rsquo;un championnat international d''ultimate.</span></li>\r\n<li style="text-align: justify;"><span style="font-size: small;"><em><strong>1982</strong></em>&nbsp;: L''Association Fran&ccedil;aise de Frisbee change de statut et devient la F&eacute;d&eacute;ration Flying Disc France, compos&eacute;e de deux comit&eacute;s&nbsp;: Ultimate et &eacute;preuves individuelles.</span></li>\r\n<li style="text-align: justify;"><strong><em><span style="font-size: small;">1998</span></em></strong><span style="font-size: small;">&nbsp;: Cr&eacute;ation du club d''Ultimate de Strasbourg : Sesquidistus membre du Strasbourg Universit&eacute; Club.&nbsp;</span></li>\r\n</ul>\r\n<p style="text-align: justify;"><span style="font-size: x-small;">Source : Article <a title="Wikip&eacute;dia " href="http://fr.wikipedia.org/wiki/Ultimate_(sport)">Wikip&eacute;dia</a>&nbsp;</span></p>'),
(4, 'L''Ultimate: mode d''emploi ', '<p><img src="modules/galerie/picture/logo-ffdf.jpg" alt="" width="160" height="144" /></p>\r\n<p>La FFDF (F&eacute;d&eacute;ration Flying Disc France) a r&eacute;alis&eacute; plusieurs vid&eacute;os pour promouvoir l''Ultimate Frisbee. Elles vous donneront tous les &eacute;l&eacute;ments et vous permettront de comprendre le sport.&nbsp;</p>\r\n<p><a title="Introduction" href="http://www.youtube.com/watch?v=uerxINkbLNU" target="_blank">Introduction</a>&nbsp;(petite pr&eacute;sentation du sport et de son histoire)</p>\r\n<p><a title="Les gestes techniques" href="http://www.youtube.com/watch?v=MuoTaA25P0M" target="_blank">Les gestes techniques</a>&nbsp;(les conseils de base pour bien lancer en revers, coup-droit et up-side)</p>\r\n<p><a title="La tactique et le jeu " href="http://www.youtube.com/watch?v=bFwfKdU6Yyc" target="_blank">La tactique et le jeu</a>&nbsp;(force, ligne et d&eacute;fense, une premi&egrave;re approche du jeu)</p>\r\n<p><a title="Les fautes " href="http://www.youtube.com/watch?v=BfSwEDoHeL8" target="_blank">Les fautes</a>&nbsp;(les fautes les plus fr&eacute;quentes)</p>\r\n<p><a title="Les exercices" href="http://www.youtube.com/watch?v=wmOkXYC_vS0" target="_blank">Les exercices</a>&nbsp;(quelques exercices pour les joueurs d&eacute;butants)</p>'),
(5, 'Les règles ', '<p><img src="modules/galerie/picture/logo-ffdf.jpg" alt="" width="160" height="144" /></p>\r\n<p><span style="font-size: small;">Le r&egrave;glement d&eacute;taill&eacute; est &agrave; consulter et &agrave; t&eacute;l&eacute;charger sur le site internet officiel de la ffdf (F&eacute;daration Flyling Disc France) : </span></p>\r\n<p><span style="font-size: small;"><a title="L''ultimate en 10 points " href="http://www.ffdf.fr/Ultimate/L-Ultimate-en-10-points" target="_blank">L''ultimate en 10 points </a></span></p>\r\n<p><span style="font-size: small;"><a title="L''ultimate approfondi" href="http://www.ffdf.fr/Ultimate/L-Ultimate-approfondi" target="_blank">L''ultimate approfondi</a>&nbsp;(T&eacute;l&eacute;chargez les r&egrave;gles compl&egrave;tes en pdf en bas de page)&nbsp;</span></p>'),
(6, 'Liens ', '<p><strong><span style="font-size: small;">Les f&eacute;d&eacute;rations :&nbsp;</span></strong></p>\r\n<p>- <a href="http://www.ffdf.fr/" target="_blank">FFDF (F&eacute;d&eacute;ration Flying Disc France)</a>&nbsp;</p>\r\n<p>- <a href="http://www.wfdf.org/" target="_blank">WFDF (Word Flying Disc Federation)</a></p>\r\n<p>- <a href="http://www.efdf.org/" target="_blank">EFDF (European Flying Disc Federation)</a></p>\r\n<p>-&nbsp;<a href="http://www.usaultimate.org/index.html" target="_blank">USA Ultimate</a>&nbsp;(F&eacute;d&eacute;ration am&eacute;ricaine)&nbsp;</p>\r\n<p>- <a href="http://www.frisbeesportverband.de/" target="_blank">Deutscher Frisbeesport-Verband</a>&nbsp;(F&eacute;d&eacute;ration allemande)&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong><span style="font-size: small;">Le site incontournable :</span></strong>&nbsp;</p>\r\n<p>- <a href="http://ffindr.com/" target="_blank">FFINDR </a>(site r&eacute;f&eacute;ren&ccedil;ant tous les tournois &agrave; travers le monde)&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong><span style="font-size: small;">Les &eacute;quipementiers :&nbsp;</span></strong></p>\r\n<p>- <a href="http://www.lookfly.com/uk/" target="_blank">Looklfy</a> (Marque anglaise des Sesquidistus)&nbsp;</p>\r\n<p>- <a href="http://fiveultimate.com/" target="_blank">Five Ultimate</a> (Marque am&eacute;ricaine)&nbsp;</p>\r\n<p>- <a href="http://www.gaiacustom.com/home" target="_blank">Ga&iuml;a</a>&nbsp;(Marque am&eacute;ricaine)</p>\r\n<p>- <a href="http://scu2-ultimate-frisbee-maillots-t-shirt-sportwear.com/" target="_blank">Scu2</a> (Marque fran&ccedil;aise de l''&eacute;quipe de France)</p>\r\n<p>- <a href="http://force-ultimate.com/index.php?lang=fr">Force Ultimate</a> (Marque fran&ccedil;aise)&nbsp;</p>\r\n<p>- <a href="http://frisbeeclothing.com/" target="_blank">Zone</a> (Marque japonaise)</p>');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id_video` int(11) NOT NULL auto_increment,
  `type` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `code` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `id_dossier` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_video`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Contenu de la table `videos`
--

INSERT INTO `videos` (`id_video`, `type`, `id`, `titre`, `description`, `code`, `image`, `id_dossier`) VALUES
(49, 'youtube', '_75Ij-G1Uus', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/_75Ij-G1Uus&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/_75Ij-G1Uus&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/_75Ij-G1Uus/1.jpg', 12),
(51, 'youtube', 'uq3pg0JcJSI', 'The Greatest Ultimate Frisbee Highlight Reel...Ever! - by UltiVillage.com', 'This highlight reel features the best open club highlights from the UV archive. As official videographer at the past 5 USA Ultimate Club Championships, WUCC 2006 &amp; 2010 and WUGC 08, UV has a ton of great highlights to pull from and these are the cream of the crop. Enjoy!', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/uq3pg0JcJSI&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/uq3pg0JcJSI&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/uq3pg0JcJSI/1.jpg', 12),
(52, 'youtube', 'uq3pg0JcJSI', 'The Greatest Ultimate Frisbee Highlight Reel...Ever! - by UltiVillage.com', 'This highlight reel features the best open club highlights from the UV archive. As official videographer at the past 5 USA Ultimate Club Championships, WUCC 2006 &amp; 2010 and WUGC 08, UV has a ton of great highlights to pull from and these are the cream of the crop. Enjoy!', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/uq3pg0JcJSI&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/uq3pg0JcJSI&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/uq3pg0JcJSI/1.jpg', 14),
(53, 'youtube', 'RBcTO0KblNA', 'On s''y met : L''ultimate Frisbee (Strasbourg)', 'plus sur http://wizdeo.com/s/alsace20 . \n Focus sur L''ultimate, un sport collectif qui se joue avec un Frisbee, basÃ© sur la mixitÃ©, l''auto-arbitrage, et surtout le fair-play. (Droits rÃ©servÃ©s. Pour toute exploitation commerciale, veuillez nous contacter http://wizdeo.com/s/contact )', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/RBcTO0KblNA&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/RBcTO0KblNA&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/RBcTO0KblNA/1.jpg', 16),
(54, 'youtube', 'LEzJYUAMPfo', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/LEzJYUAMPfo&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/LEzJYUAMPfo&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/LEzJYUAMPfo/1.jpg', 16),
(55, 'youtube', 'Qrg1ehnmu_Q', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/Qrg1ehnmu_Q&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/Qrg1ehnmu_Q&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/Qrg1ehnmu_Q/1.jpg', 16),
(56, 'youtube', 'cFRx9ZtbCYc', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/cFRx9ZtbCYc&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/cFRx9ZtbCYc&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/cFRx9ZtbCYc/1.jpg', 16),
(57, 'youtube', 'aAyEti-_lR8', 'Ultimate Frisbee Highlights', 'Taken from UltiVillage.com. This is possibly one the best videos I''ve ever seen. Gotta crank the music up on this one!', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/aAyEti-_lR8&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/aAyEti-_lR8&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/aAyEti-_lR8/1.jpg', 14),
(58, 'youtube', '2fkXa9SGuOs', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/2fkXa9SGuOs&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/2fkXa9SGuOs&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/2fkXa9SGuOs/1.jpg', 16),
(61, 'youtube', '6UHbwWqPUw0', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/6UHbwWqPUw0&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/6UHbwWqPUw0&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/6UHbwWqPUw0/1.jpg', 12),
(62, 'youtube', '-6RUo1Wq4IQ', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/-6RUo1Wq4IQ&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/-6RUo1Wq4IQ&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/-6RUo1Wq4IQ/1.jpg', 14),
(63, 'youtube', '3MK98mUAdNc', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/3MK98mUAdNc&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/3MK98mUAdNc&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/3MK98mUAdNc/1.jpg', 14),
(64, 'youtube', 'GmkUZDPVbFE', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/GmkUZDPVbFE&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/GmkUZDPVbFE&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/GmkUZDPVbFE/1.jpg', 12),
(65, 'youtube', 'rpe4mRK-Q0A', 'You won''t believe these Ultimate Frisbee plays!', 'Men''s Ultimate Frisbee highlights from the national championships in Florida', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/rpe4mRK-Q0A&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/rpe4mRK-Q0A&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/rpe4mRK-Q0A/1.jpg', 12),
(66, 'youtube', 'QQucg25GAkI', 'Sockeye v. Colombia', 'En cuartos de final, Mundial de Paises Vancouver, BC', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/QQucg25GAkI&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/QQucg25GAkI&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/QQucg25GAkI/1.jpg', 14),
(67, 'youtube', 'JLR0nbGU0co', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/JLR0nbGU0co&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/JLR0nbGU0co&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/JLR0nbGU0co/1.jpg', 14),
(71, 'youtube', 'v8OEGvZVWhc', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/v8OEGvZVWhc&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/v8OEGvZVWhc&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/v8OEGvZVWhc/1.jpg', 17),
(72, 'dailymotion', 'xguba9', 'Ultimate mode d''emploi : Intro &amp; Conclusion', 'Le d&amp;eacute;veloppement par l''image... Depuis quelques ann&amp;eacute;es, la F&amp;eacute;d&amp;eacute;ration Flying Disc France (www.ffdf.fr) innove et cherche &amp;agrave; d&amp;eacute;velopper son image et ses activit&amp;eacute;s aupr&amp;egrave;s d''un publi', '<object class="video" width="700" height="500"><param name="movie" value="http://www.dailymotion.com/swf/video/xguba9?background=493D27&foreground=E8D9AC&highlight=FFFFF0"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/xguba9?background=493D27&foreground=E8D9AC&highlight=FFFFF0" width="700" height="500" allowfullscreen="true" allowscriptaccess="always"></embed></object>', 'http://ak2.static.dailymotion.com/static/video/:jpeg_preview_large.jpg', 17),
(73, 'youtube', '0iyMkxHsSfc', '', '', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/0iyMkxHsSfc&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/0iyMkxHsSfc&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/0iyMkxHsSfc/1.jpg', 12),
(74, 'dailymotion', 'xguc1c', 'Ultimate mode d''emploi : Les Gestes Techniques', 'Le d&amp;eacute;veloppement par l''image... Depuis quelques ann&amp;eacute;es, la F&amp;eacute;d&amp;eacute;ration Flying Disc France (www.ffdf.fr) innove et cherche &amp;agrave; d&amp;eacute;velopper son image et ses activit&amp;eacute;s aupr&amp;egrave;s d''un publi', '<object class="video" width="700" height="500"><param name="movie" value="http://www.dailymotion.com/swf/video/xguc1c?background=493D27&foreground=E8D9AC&highlight=FFFFF0"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/xguc1c?background=493D27&foreground=E8D9AC&highlight=FFFFF0" width="700" height="500" allowfullscreen="true" allowscriptaccess="always"></embed></object>', 'http://ak2.static.dailymotion.com/static/video/:jpeg_preview_large.jpg', 17),
(75, 'dailymotion', 'xgpg1j', 'Ultimate Mode d''emploi', 'Le d&amp;eacute;veloppement par l''image... Depuis quelques ann&amp;eacute;es, la F&amp;eacute;d&amp;eacute;ration Flying Disc France (www.ffdf.fr) innove et cherche &amp;agrave; d&amp;eacute;velopper son image et ses activit&amp;eacute;s aupr&amp;egrave;s d''un publi', '<object class="video" width="700" height="500"><param name="movie" value="http://www.dailymotion.com/swf/video/xgpg1j?background=493D27&foreground=E8D9AC&highlight=FFFFF0"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/xgpg1j?background=493D27&foreground=E8D9AC&highlight=FFFFF0" width="700" height="500" allowfullscreen="true" allowscriptaccess="always"></embed></object>', 'http://ak2.static.dailymotion.com/static/video/:jpeg_preview_large.jpg', 17),
(76, 'dailymotion', 'xguumz', 'Ultimate mode d''emploi : Ultimate en Fauteuil', 'Le d&amp;eacute;veloppement par l''image... Depuis quelques ann&amp;eacute;es, la F&amp;eacute;d&amp;eacute;ration Flying Disc France (www.ffdf.fr) innove et cherche &amp;agrave; d&amp;eacute;velopper son image et ses activit&amp;eacute;s aupr&amp;egrave;s d''un publi', '<object class="video" width="700" height="500"><param name="movie" value="http://www.dailymotion.com/swf/video/xguumz?background=493D27&foreground=E8D9AC&highlight=FFFFF0"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/xguumz?background=493D27&foreground=E8D9AC&highlight=FFFFF0" width="700" height="500" allowfullscreen="true" allowscriptaccess="always"></embed></object>', 'http://ak2.static.dailymotion.com/static/video/:jpeg_preview_large.jpg', 17),
(77, 'dailymotion', 'xgutek', 'Ultimate mode d''emploi : Les Fautes', 'Le d&amp;eacute;veloppement par l''image... Depuis quelques ann&amp;eacute;es, la F&amp;eacute;d&amp;eacute;ration Flying Disc France (www.ffdf.fr) innove et cherche &amp;agrave; d&amp;eacute;velopper son image et ses activit&amp;eacute;s aupr&amp;egrave;s d''un publi', '<object class="video" width="700" height="500"><param name="movie" value="http://www.dailymotion.com/swf/video/xgutek?background=493D27&foreground=E8D9AC&highlight=FFFFF0"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/xgutek?background=493D27&foreground=E8D9AC&highlight=FFFFF0" width="700" height="500" allowfullscreen="true" allowscriptaccess="always"></embed></object>', 'http://ak2.static.dailymotion.com/static/video/:jpeg_preview_large.jpg', 17),
(78, 'dailymotion', 'xguf4c', 'Ultimate mode d''emploi : La Tactique &amp; le Jeu', 'Le d&amp;eacute;veloppement par l''image... Depuis quelques ann&amp;eacute;es, la F&amp;eacute;d&amp;eacute;ration Flying Disc France (www.ffdf.fr) innove et cherche &amp;agrave; d&amp;eacute;velopper son image et ses activit&amp;eacute;s aupr&amp;egrave;s d''un publi', '<object class="video" width="700" height="500"><param name="movie" value="http://www.dailymotion.com/swf/video/xguf4c?background=493D27&foreground=E8D9AC&highlight=FFFFF0"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/xguf4c?background=493D27&foreground=E8D9AC&highlight=FFFFF0" width="700" height="500" allowfullscreen="true" allowscriptaccess="always"></embed></object>', 'http://ak2.static.dailymotion.com/static/video/:jpeg_preview_large.jpg', 17),
(80, 'youtube', '3Zj7Ybh7GCg', 'Urban free z beach act III', 'tournoi de beach ultimate 4/4. A pont a mousson le 02 et 3 juillet 2011', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/3Zj7Ybh7GCg&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/3Zj7Ybh7GCg&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/3Zj7Ybh7GCg/1.jpg', 16),
(81, 'youtube', 'HhUays2ehyI', 'Best Ultimate Frisbee Highlight Reel 2011 - ETP Series Ultivillage', 'LIKE/FAV for the sport Ultimate Frisbee\r\nPlease subscribe to my channel and my other channels! I make new videos here every week and make darkhorse vlogs daily.\r\nhttp://youtube.com/brodiesmith21\r\nhttp://youtube.com/everythingultimate\r\nhttp://youtube.com/brodiesmithvlog\r\n\r\nThanks to Ultivillage for providing us with these clips.  To view full game footage check them out at:\r\nhttp://ultivillage.com\r\n\r\nMusic by Keenan Herbon: "Beats"\r\nhttps://twitter.com/#!/Pullingdown9\r\n\r\nSICK SWAG!\r\nâ€ªhttp://breakmark.com/partners/everything-ultimate\r\n\r\nâ€¨â€¨LIKE US ON FACEBOOK!â€¨â€ª\r\nhttp://facebook.com/brodiesmithultimateâ€¨â€ª\r\nhttp://facebook.com/frisbeetrickshots\r\n\r\nâ€¨â€¨FOLLOW ME ON TWITTER!\r\nâ€¨â€ªhttp://twitter.com/brodiesmith21\r\n\r\nâ€¨â€¨GOOGLE+\r\nâ€¨â€ªhttps://plus.google.com/104512050017150354130\r\n\r\nâ€¨â€¨Got some sick shots? We want to see them!â€¨\r\nSend them to everythingultimate@gmail.com\r\n\r\nTags: Best Ultimate Frisbee Highlight Reel 2011 ETP Series Ultivillage Ultimate Frisbee Highlights Top 10 Plays Brodie Smith "Ultimate Frisbee Highlights" Everything Ultimate Bro Tips Florida Jumping Diving layout sky disc huck backhand flick "Best Ultimate Highlights" Best greatest ultivillage discraft disc golf favorite', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/HhUays2ehyI&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/HhUays2ehyI&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/HhUays2ehyI/1.jpg', 14),
(82, 'youtube', 't3FdhsHujME', 'Keep Your Mustache''12 by Sesquidistus - Teaser.wmv', 'Keep Your Mustache / International Ultimate Frisbee Tournament \nIn Erstein / France \nBy Sesquidistus / Strasbourg \n2-3 June 2012', '<object class="video" width="700" height="500"><param name="movie" value="http://www.youtube.com/v/t3FdhsHujME&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed class="video" src="http://www.youtube.com/v/t3FdhsHujME&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed></object>', 'http://img.youtube.com/vi/t3FdhsHujME/1.jpg', 12);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type_event` (`numero`) ON DELETE CASCADE;

--
-- Contraintes pour la table `forum_msg`
--
ALTER TABLE `forum_msg`
  ADD CONSTRAINT `forum_msg_ibfk_1` FOREIGN KEY (`ID_TOPIC`) REFERENCES `forum_topic` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `forum_scat`
--
ALTER TABLE `forum_scat`
  ADD CONSTRAINT `forum_scat_ibfk_1` FOREIGN KEY (`ID_CAT`) REFERENCES `forum_cat` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `forum_topic`
--
ALTER TABLE `forum_topic`
  ADD CONSTRAINT `forum_topic_ibfk_1` FOREIGN KEY (`ID_SCAT`) REFERENCES `forum_scat` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inscription_tournoi`
--
ALTER TABLE `inscription_tournoi`
  ADD CONSTRAINT `inscription_tournoi_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponse_inscription_tournoi`
--
ALTER TABLE `reponse_inscription_tournoi`
  ADD CONSTRAINT `reponse_inscription_tournoi_ibfk_1` FOREIGN KEY (`id_formulaire`) REFERENCES `inscription_tournoi` (`id_formulaire`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponse_sondage`
--
ALTER TABLE `reponse_sondage`
  ADD CONSTRAINT `reponse_sondage_ibfk_1` FOREIGN KEY (`id_sondage`) REFERENCES `sondage` (`id_formulaire`) ON DELETE CASCADE;
