$(document).ready(function(){
    floatingMenu.add('floatdiv',
        {
            // Represents distance from top or
            // bottom browser window border
            // depending upon property used.
            // Only one should be specified.
            targetTop: 10,
            // targetBottom: 0,

            // prohibits movement on x-axis
            prohibitXMovement: true,
            // Remove this one if you don't
            // want snap effect
            snap: true
        });
});