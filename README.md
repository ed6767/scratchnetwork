# scratchnetwork
The entire of ScratchNetwork

## Deployment for Dummies
!! Deploying your own instance is **NOT ADVISED** due to this versions reliance on files and other security issues !!

1. Clone this repo to an active PHP 7.0+ server

2. You most likely do not have a Firebase database or a correctly configured Composer setup, nor do I even remember the correct structure for the buggy comment system. So open server.php in the root folder and remove:
  - Lines 28 - 45
  - Line 64 and 65
  
3. **Turn on error reporting by removing line 3 and line 7** - this will relieve SO MUCH pain.

4. Open up index.php in your browser, the UI should load and you'll most likely read an error in the content area. If at this point. If you did step 2 right, you should see the goodbye message full of false promises.

5. Download the ScratchNetwork archives from https://drive.google.com/open?id=1kktXBgv4qpoCzd0loybpP49VCXpyaGfj

6. Extract the ZIP to the root directory.

7. Head back over to your index page and click "Browse" to refresh the request. There is no need to refresh the entire UI. Nothing much will change but the member and post count. This is what you want. Anything else probably means you've extracted to the wrong path (i.e ensure both the 'users' and 'items' directories were extracted to the same folder as index.php)

8. Head over to `/server.php?action=downaccess` in your browser - this gives you access past the "down" message.

8.5. If you see the "undefined offset" error, replace all instances of `explode("/", $e->getFile())[7]` with `$e->getFile()`.

9. Head back to index.php and reload. The posts should now appear and you can basically roam this desolate land, but it's not fully working yet. You may see many "Not found" errors, and can't log in.

10. We need to find the soure of these errors. Head back to server.php at line 105 and remove the HTML comment tags around the error information. (the `<!--` at the beggining and the `-->` at the end)

11. Click "Sign in with Scratch" in the sidebar. The "Not Found" error here is due to the list of words used to generate a log in key not existing. Create a new file in the root directory called "words.txt" and fill it with random words, seperated by newlines.

12. Click 'Close' then click 'Sign in with Scratch' again. Follow the instructions. You can still use old accounts if you were in before, and edit your permissions to make you an admin.

### And that's it. You should have a (mostly) functional deployment of ScratchNetwork! Have fun.
Comments should still work as the Firebase instance is still up as of Feb 2020, **read only.**. If it no longer is, a backup is included in this repo.



Discontinued. Feel free to work on this and deploy your own versions using PHP 7.0+,however I will provide no support.
