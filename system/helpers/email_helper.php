<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Email Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/email_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('valid_email'))
{
	/**
	 * Validate email address
	 *
	 * @deprecated	3.0.0	Use PHP's filter_var() instead
	 * @param	string	$email
	 * @return	bool
	 */
	function valid_email($email)
	{
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('send_email'))
{
	/**
	 * Send an email
	 *
	 * @deprecated	3.0.0	Use PHP's mail() instead
	 * @param	string	$recipient
	 * @param	string	$subject
	 * @param	string	$message
	 * @return	bool
	 */
	function send_email($recipient, $subject, $message)
	{
		return mail($recipient, $subject, $message);
	}
	
	
	function confirmation_mail($name=NULL,$company=NULL,$username=NULL,$password=NULL)
	{

$mailsec=

'<table width="500" border="0" cellpadding="0" cellspacing="0" style="background-color: aliceblue">
  	<tr><td style=" height:90px;" ><table width="100%" border="0"><tr>
  	
  	  <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:24px; color:#FFFFFF; text-align: center;">
   			<img src="'.base_url().'media/images/cmpny_logo.png" width="200" height="130" />
	</td> <td>&nbsp;&nbsp;</td>
  	

  </tr>
</table></td>
      	</tr>
  	<tr><td style="background-color:#fff; height:2px;"></td></tr>
  	<tr>
    	<td style="background-color:#E762A6;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#FFFFFF; padding-left:5px; text-align:center; height:30px;">Become A MSDR Member !</td>
  	</tr>
  	<tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; padding:15px;">
          Dear  <span style="text-transform:capitalize; font-weight:600;">'.$name.'</span>,<br>
		Congratulations on your promotion normal member in <span style="font-weight:600">'.$company.'</span> family. I’ve seen to excellent effort, As you worked toward this victory, you behaved with such humility, grace <br />and kindness to others. I appreciate how you always share your success with your team, and your lovefor your community is one of the reasons you rise to the top.  I can wholeheartedly say that you’re bringing positive change to this company.
I know you’ve worked incredibly hard for this position, and with that being said,I also know that you<br />  deserve the new recognition and responsibility. I look forward toworking with you more  <br />closely in the future.
		<br />
		<div style="text-align: center;font-weight: bold;font-size: 16px;padding: 14px; color: #af0e5f;"> 
				Below is your detail of login detials.
		</div><br />
		 <div style="margin-left: 150px;"> 
		 	<span style="font-weight:600;text-transform: uppercase;">Username</span>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;'.$username.'<br>
		  	<span style="font-weight:600;text-transform: uppercase;">Password</span>&nbsp; &nbsp;: &nbsp;'.$password.'<br>
         </div>
		<div align="center" style="margin-top:20px;">  
			<a class="login" href="'.base_url().'"  target="_blank" style="color: #FFF;text-decoration: none;padding: 10px;background-color: #1e5475;font-weight: bold;text-transform: uppercase;border-radius: 5px;">Login to your account</a>
		</div><br /><br />
	<hr style="border:dashed 1px #CCCCCC;" /><br />
If the above link doesnt work , kindly copy and paste the same into browsser URL , and press enter !<br />
Best wishes for continued success in your career.<br /><br />
Thanks <br />
Team ,<br />
<span style="text-transform:uppercase; font-weight:bold;">MSDR Global Marketting Private Limited</span><br /><br />
 </td></tr>
  	<tr><td style="background-color:#E762A6;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#FFFFFF; padding-left:5px; text-align:center; height:30px;"> This is an auto generated mail , hence no need to reply.</td>
  	</tr>
    <tr><td style="background-color:#fff; height:0px;"></td></tr>
    <tr><td style="background-color:#063552; height:15px;"></td></tr> 	
</table>

';				

	return $mailsec;

	}
	
	
}
