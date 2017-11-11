package oe.util;

import oe.ui.LoginController;
import org.apache.log4j.Logger;

public class Assert {
    private static Logger log = Logger.getLogger(LoginController.class.getName());

    /**
     * Assert that an object is not null.
     * @param arg
     * @param message
     */

    public static void notNull(Object arg, String message) {
        if (arg == null) throw new IllegalArgumentException(message);
    }

    public static void notEmpty(String arg, String message) {
        notEmpty(arg, message, false);
    }

    public static void notEmpty(String arg, String message, boolean logError) {
        if (arg == null || arg.isEmpty()) {
            if (logError) log.error(message);
            throw new IllegalArgumentException(message);
        }
    }

}
