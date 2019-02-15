export class layout {
    constructor() {

        // window.localStorage.setItem("layout", "White");
    }

    setLayout(layoutName) {
        window.localStorage.layout = layoutName;
    }
    getlayoutName() {
        return window.localStorage.getItem("layout") || "White";
    }

    getColor() {
        let layoutName = this.getlayoutName();
        switch (layoutName) {
            case "White":
                document.querySelector('main').setAttribute("style", "background-color: aqua;");
                document.querySelector('footer').setAttribute("style", "background-color: aquamarine;");
                return {
                    nav: {
                        backgroundColor: "black",
                    },
                    main: {
                        backgroundColor: "aqua",

                    },
                    footer: {
                        backgroundColor: "aquamarine",

                    }
                };
            case "Dark":
                document.querySelector('main').setAttribute("style", "background-color: aquamarine;");
                document.querySelector('footer').setAttribute("style", "background-color: aquamarine;");
                return {
                    nav: {
                        backgroundColor: "darkblue",
                    },
                    main: {
                        backgroundColor: "aquamarine",
                    },
                    footer: {
                        backgroundColor: "aquamarine",

                    }
                };
            case "Green":
                document.querySelector('main').setAttribute("style", "background-color: green;");
                document.querySelector('footer').setAttribute("style", "background-color: aquamarine;");
                return {
                    nav: {
                        backgroundColor: "red",


                    },
                    main: {
                        backgroundColor: "currentColor",

                    },
                    footer: {
                        backgroundColor: "aquamarine",

                    }
                };
            default:
                document.querySelector('main').setAttribute("style", "background-color: aqua;");
                document.querySelector('footer').setAttribute("style", "background-color: aquamarine;");
                return {
                    nav: {
                        backgroundColor: "red",


                    },
                    main: {
                        backgroundColor: "red",

                    },
                    footer: {
                        backgroundColor: "aquamarine",

                    }
                };
        }
    }
}