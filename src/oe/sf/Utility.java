package oe.sf;

import com.sforce.soap.enterprise.SaveResult;
import com.sforce.soap.enterprise.sobject.SObject;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Hashtable;

public class Utility {

    /**
     * return Ids in csv string
     * @param array
     * @return not null
     */
    public static String getCsvId(SObject[] array) {
        StringBuilder sb = new StringBuilder();
        Arrays.stream(array).forEach(o -> sb.append("'").append(o.getId()).append("',"));
        if (array.length > 1 && sb.charAt(sb.length()-1) == ',') sb.deleteCharAt(sb.length()-1);
        return sb.toString();
    }

    public static boolean SfIDEqual(String id1, String id2) {
        if (id1 == id2 ) return true;

        String s1 = id1 == null ? "" : id1.substring(0, Math.min(id1.length(), 15));
        String s2 = id2 == null ? "" : id2.substring(0, Math.min(id2.length(), 15));

        return s1.equals(s2);
    }
}
