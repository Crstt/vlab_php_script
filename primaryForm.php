<?php
$data = [
    'id' => '',
    'date' => '',
    'name' => '',
    'title' => 'V-Lab Sign In',
    'dept' => 'Tutoring Services',
    'abbr' => 'FWT',
    'intro' => 'Welcome to the drop-in tutoring lab from the Fort Wayne Tutoring Services.',
    'reason' => '',
    'room' => 'Online',
    'target' => '1m2nJenoz4gqOzWGAo-WmiwvOmIru9-_Btg7mjtaTV-Y',
    'backup' => '1m8cTh8K2lm7tEne67VthAS770mT_fqf_LdfRIWaqAa8',
    'url' => 'https://ivytech.zoom.us/my/fwcae',
    'homepage' => 'https://fwtutoringservices.com/',
    'consultant' => 'Tutor'
];

?>

<!doctype html>
<!-- Author:        Jeremy Nally, Matteo Catalano -->
<!-- Date Written:  May 24, 2021 -->
<!-- File:          index.html -->
<!-- Description:   index file for NEW CAE Lab Sign In (working title) -->
<!-- Last Modified: Jan 18, 2024 -->
<html lang="en">
<head>
    <meta charset="utf-8" />
  <link rel="stylesheet" href="formStyle.css" />
</head>
<body>
<div id="wrapper">
<header>
  <div id="title">
    <h2><a href="<?php echo $data['homepage']; ?>" target="_blank"><?php echo $data['dept']; ?></a></h2>
    <h1><?php echo $data['title']; ?></h1>
  </div> <!--title-->
    <a href="https://ivytech.edu" target="_blank">
        <img src="https://caeivy.com/images/IVY_HZ_C.jpg" height="50" width="113" alt="Ivy Tech Community College Fort Wayne" title="Ivy Tech Community College Fort Wayne" />
    </a>
  <div style="clear: both;" ></div>
</header>
<p><?php echo $data['intro']; ?></p>
<p>You are logged in as <strong><?php echo $_SESSION['email']; ?></strong>.</p>
<div id="referralContent" >
<form id="referralForm">
  <fieldset style="margin-bottom: 0; padding-bottom: 0;">
    <label>Course</label>
    <br />
    <select id="course" name="course">
      <option value="mt" disabled selected>Select a Course or Other</option>
<?!= courses[0]; ?>
      <!--<option value="">Other</option>-->
    </select>
<?!= courses[1]; ?>
    <br />
    <div id="reasonDiv">
    <label>Reason</label>
    <br />
    <select id="reason" name="reason">
      <option value="OR">Other (Specify in Notes)</option>
      <option value="MathHelp">Math Help</option>
      <option value="Research">Research</option>
      <option value="Writing">Writing</option>
      <option value="StudySkills">Study Skills</option>
      <option value="IL">IvyLearn</option>
      <option value="MY">MyIvy</option>
      <option value="EH">Email Help</option>
      <option value="PH">Print Help</option>
      <option value="SO">Student Orientation</option>
      <option value="DD">Destination Diploma</option>
      <option value="MO">Microsoft Office</option>
      <option value="SC">Scheduling Classes</option>
      <option value="CH">Computer Help</option>
      <option value="FA">Financial Aid</option>
    </select>
    </div>
    <br />
    <!-- <label>Notes</label>
    <br />
    <input id="notes" type="text" name="notes" placeholder="Help is needed with a paper.">
    <br /> -->
    <label>Notes (optional)</label>
    <br />
    <textarea id="notes" name="notes" rows="4" cols="50" placeholder="Enter what you specifically need help with today."></textarea>
    <br />
    <p id="errorMsg" class="red"></p>
    <input id="jstring" type="hidden" name="jstring" value='<?!= jstring ?>' />
    <input type="reset" name="reset" value="Clear" />
    <input id="btnSubmit" type="submit" name="btnSubmit" value="Submit" />
  </fieldset>
</form>
</div><!--referralContent-->
<footer>&copy; <?!= (new Date()).getFullYear(); ?>. Ivy Tech Community College Fort Wayne. <br />
        Developed by <a href="https://jeremynally.com" target="_blank">Jeremy Nally</a>, <a href="https://github.com/Crstt" target="_blank">Matteo Catalano</a>, and <a href="https://fwtutoringservices.com" target="_blank">Fort Wayne Tutoring Services</a>.<br />
</footer>
</div><!--wrapper-->
<?!= include('javascript'); ?>
</body>
</html>