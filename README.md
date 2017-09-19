# Arifu-Test-Project
Manage students courses and certification awarding

Expectations :<br>
● Collect a student’s personal details from a webpage.<br>
● Store the information in a database.<br>
● Visualize your work; provide a well-presented way to show how many students have
applied and received a copy of the digital certificate. e.g. Plot applications received daily,
display statistics for how many certificates generated per course.<br>
● Extended work would be to take the collected details and prepare a certificate in pdf.
Send the generated certificate as an attachment to the email the student provided.

##Usage node install npm install angular2-image-popup bower install bower install image-popup
###1.In index.html page include following css 
###2.component file use like below import {Component} from '@angular/core';
import {ImageModal} from '../directives/angular2-image-popup/image-modal-popup';
@Component({ selector : 'my-app', directives: [ImageModal], template: `
