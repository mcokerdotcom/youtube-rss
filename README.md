# youtube-rss

Allows you to fetch YouTube channel/user pages via RSS.

I made this after I've seen YouTube suppressing channel/user feeds from showing up in my subscription page.

Usage is a GET query string in the URL called "channel" with "|" delimited pairs of either "channel" or "user" and the channel/user ID separated by a ":"

An example:

http://website.com/youtube-rss/?channel=channel_id:UClFSU9_bUb4Rc6OYfTt5SPw|user:JordanPetersonVideos|channel_id:UCzQUP1qoWDoEbmsQxvdjxgQ
