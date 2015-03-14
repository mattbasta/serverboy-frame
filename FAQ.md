# Introduction #

Here are some of the most frequently asked questions about Frame:

**Why use a CSS framework?**

CSS frameworks make developing a website much easier than developing a website without one. Common design patterns are already implemented in Frame, making the time it takes to create rich internet application significantly less than it otherwise might if you were doing it by hand.

Consider this: how much time will you spend debugging a site layout to work across multiple browsers? If you outsource your layout to Frame, the time you spend testing across browsers is significantly lessened: we do all the IE testing for you beforehand!

**What kind of overhead can I experience with Frame?**

When it is gzipped, Frame is about 15kb. On a broadband connection, this can take less than 100ms to load.

**Some other CSS libraries are under {insert ridiculously low number here}kb. Why is Frame so big?**

In comparison, Frame may seem very large. At the same time, we provide the functionality of many CSS libraries combined together. For instance, consider the following scenario:

|Stylesheet|Function|Size|
|:---------|:-------|:---|
|Hartija|Print layout|1.6kb|
|960.gs|Screen layout|5.4kb|
|Blueprint|Typography|3.4kb|
|RMSForms|Form Layout|7.9kb|
|Total| |18.3kb|

If you had chosen these four libraries instead of Frame, you would use more bandwidth to transfer the instructions. If they were separate files, you would also introduce overhead from having three extra HTTP requests.

**There's stuff in Frame that I don't want/need.**

That's cool too! Check out this page: http://frame.serverboy.net/build

You can use that to build a custom implementation.

**Why does my browser report warnings in the CSS?**

All browsers don't work the same way, and so some browsers require special code to make them work. Frame does not use invalid CSS hacks (hacks that break the CSS syntax), though we do include proprietary CSS descriptors (such as `-moz-border-radius`). Other browsers may use descriptor values that other browsers do not support. For instance, Opera and WebKit respond to `padding:initial`, while Gecko-based browsers do not.