
//// Type Quietly ////

// Looks for repeated sequences of uppercase letters being keyed in;
// politely asks user to stop 'shouting'!
// At the moment it only works when the user is typing at the end of the message.
// Should catch most occurrences though.

// Maximum caps in a row (after stripping all non-alphabetical characters)
// Setting this too low may cause it to be triggered by uppercase BBCode/HTML tags
// or acronyms and the like
var TQ_MAX_CAPS = 8;

// Maximum size of text range to sample (should be >= TQ_MAX_CAPS)
var TQ_SAMPLE_SIZE = 16;

// Cutoff point; disable Type Quietly if the message gets long
var TQ_CUT_OFF_POINT = 8192;

// Message to display when user is shouting
var TQ_MESSAGE =
   'You seem to be typing in \'all capitals\'.\n\n' +
   'This is not usually a good idea: it can make\n' +
   'your message harder to read or might indicate  \n' +
   'you are \'shouting\'.\n\n' +
   'Please make sure Caps Lock is off, and type in\n' +
   'mixed or small letters. Thanks!'

// Initialisation: Leave these lines as is
var tqIsActive = true;
var tqPrevEndChars = '';
var tqPrevLength = 0;
var tqPrevElement = '';

// Main Type Quietly function
// Always return true in case some 'clever' browser decides to cancel the keypress
function typeQuietly (textEl, event) {
   // Check if active
   if (!tqIsActive) {
      return true;
   }

   // Check arguments
   if ((typeof textEl != 'object') || (typeof event != 'object')) {
      return true;
   }

   // Check string handling requirements (should be fine for IE 4+, NS 4+ etc.)
   if ((typeof RegExp != 'function') || (typeof textEl.value.substr) != 'function') {
      return true;
   }
   
   // Deactivate if message too long
   if (textEl.value.length > TQ_CUT_OFF_POINT) {
      tqIsActive = false;
      return true;
   }

   // Check message is long enough to trigger
   if (textEl.value.length < TQ_MAX_CAPS) {
      return true;
   }

   // Sample last characters of message
   var lastChars = '';
   var selectStart, selectLength;
   if (textEl.value.length < TQ_SAMPLE_SIZE) {
      selectStart = 0;
      selectLength = textEl.value.length;
   }
   else {
      selectStart = textEl.value.length - TQ_SAMPLE_SIZE;
      selectLength = TQ_SAMPLE_SIZE;
   }
   lastChars = textEl.value.substr(selectStart, selectLength);
   
   // Check we caught something
   if (lastChars.length == 0) {
      return true;
   }

   // If we're now looking at a different element, reset
   if ((tqPrevElement == '') || (tqPrevElement != textEl.name)) {
      tqPrevEndChars = lastChars;
      tqPrevLength = 0;
      tqPrevElement = textEl.name;
      return true;
   }   

   // End of message must be changing
   if (lastChars == tqPrevEndChars) {
      return true;
   }
   tqPrevEndChars = lastChars;

   // Last character must itself be a capital
   if (lastChars.substr(lastChars.length - 1, 1).search(eval('/[A-Z]/')) == -1) {
      return true;
   }

   // Don't trigger when deleting or on first keypress
   if ((tqPrevLength == 0) || (textEl.value.length < tqPrevLength)) {
      tqPrevLength = textEl.value.length;
      return true;
   }
   tqPrevLength = textEl.value.length;

   // Strip non-alphabetical characters and trim to size
   lastChars = lastChars.replace(eval('/[^a-zA-Z]/g'), '');
   if (lastChars.length > TQ_MAX_CAPS) {
      lastChars = lastChars.substr(lastChars.length - TQ_MAX_CAPS, TQ_MAX_CAPS);
   }
   else
   {
      // length doesn't exceed TQ_MAX_CAPS
      return true;
   }

   // Show message if needed
   if (lastChars == lastChars.toUpperCase()) {
      alert (TQ_MESSAGE);
      tqIsActive = false;
   }

   return true;
}

//// [end of Type Quietly code] ////
