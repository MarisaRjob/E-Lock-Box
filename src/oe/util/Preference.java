package oe.util;

import org.apache.log4j.Logger;

import java.io.*;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.prefs.BackingStoreException;
import java.util.prefs.InvalidPreferencesFormatException;
import java.util.prefs.Preferences;

/**
 * Created by rui.ma on 9/21/2017.
 */
public class Preference {
    public static String WhoCanUseTool = "WhoCanUseTool";
    public static String sf_sandboxEndPoint = "sf.sandboxEndPoint";
    public static String sf_prodEndPoint = "sf.prodEndPoint";
    public static String SanboxURL = "https://openedgepay--admin4.cs67.my.salesforce.com/";
    public static String ProductionURL = "https://openedgepay.my.salesforce.com/";
    //log
    private static Logger log = Logger.getLogger(Preference.class.getName());
    private static String PREF_NAME = "oe.sfAdminTools.pref";

    public static void overwriteDefaultPrefName(String name) {
        PREF_NAME = name;
    }

    public static Preferences getUserPref() {
        return Preferences.userRoot().node(PREF_NAME);
    }

    public static Preferences getSysPref() {
        return Preferences.systemRoot().node(PREF_NAME);
    }

    public static String mustGetSysSetting(String key, String errorMsg) {
        String value = getSysPref().get(key, "");
        Assert.notEmpty(value, errorMsg, true);
        return value;
    }

    /**
     * Import Pref to importToPref if prefFileName exists then delete the file.
     * @param importToPref assume not to be null.
     * @param prefFileName if empty or null, no operation is performed
     */
    public static void importPrefIfFileExistAndDelete(Preferences importToPref, String prefFileName) {

        if (prefFileName == null || prefFileName.isEmpty()) return;

        Path filePath = Paths.get(prefFileName);
        if (Files.exists(filePath)) {
            importPref(importToPref, prefFileName);
            try {
                Files.delete(filePath);
            } catch (IOException e) {
                log.error(e);
            }
        }
    }

    public static void importPref(Preferences pref, String prefFileName) {

        InputStream is;
        try {
            is = new BufferedInputStream( new FileInputStream( prefFileName));
            Preferences.importPreferences(is);

        } catch (InvalidPreferencesFormatException | IOException e) {
            log.error(e);
        }
    }

    /**
     * Export pref preference to file exportFilePath
     * @param pref cannot be null
     * @param exportFilePath cannot be emppty
     */
    public static void exportPref(Preferences pref, String exportFilePath) {
        Assert.notNull(pref, "pref argument cannot be null");
        Assert.notEmpty(exportFilePath, "exportFileName cannot be empty");

        try {
            OutputStream os = new BufferedOutputStream(
                    new FileOutputStream( exportFilePath));
            pref.exportSubtree(os);
            os.close();

        } catch (IOException | BackingStoreException ioEx) {
            log.error(ioEx);
        }
    }



}
