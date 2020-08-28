class Notification {
    // succuss notification
    success() {
        new Noty({
            type: "success",
            layout: "topRight",
            text: "Successfully Done!",
            timeout: 1000
        }).show();
    }

    // alert notification
    alert() {
        new Noty({
            type: "alert",
            layout: "topRight",
            text: "Are you Sure?",
            timeout: 1000
        }).show();
    }

    // error notification
    error() {
        new Noty({
            type: "alert",
            layout: "topRight",
            text: "Something Went Wrong!",
            timeout: 1000
        }).show();
    }
    // warning notification
    warning() {
        new Noty({
            type: "warning",
            layout: "topRight",
            text: "Opps Wrong",
            timeout: 1000
        }).show();
    }

    // image_validation notification
    image_validation() {
        new Noty({
            type: "error",
            layout: "topRight",
            text: "Upload image less than 1MB",
            timeout: 1000
        }).show();
    }
}

export default Notification = new Notification();
