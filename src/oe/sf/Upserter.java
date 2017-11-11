package oe.sf;

import com.sforce.soap.enterprise.SaveResult;
import com.sforce.soap.enterprise.sobject.SObject;
import com.sforce.ws.ConnectionException;
import oe.util.Assert;
import org.apache.log4j.Logger;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Hashtable;

import static oe.sf.Utility.SfIDEqual;

public abstract class Upserter<T extends SObject> {
    private static Logger log = Logger.getLogger(Conn.class.getName());
    protected T[] upserterSObjs;
    protected SaveResult[] results;

    /**
     * contructor for preparing array to be updated in Salesforce
     * @param sObjects to be updated in Salesforce; cannot be null
     */
    public Upserter(T[] sObjects) {
        Assert.notNull(sObjects, "sObjects cannot be null");
        upserterSObjs = sObjects;
    }

    /**
     * Make update to Salesforce
     * @return true if everything is updated correctly.
     * @throws ConnectionException
     */
    public boolean performOnSf() throws ConnectionException {
        results = perform(upserterSObjs);
        return !Arrays.stream(results).anyMatch(r -> r.isSuccess() == false);
    }

    public abstract SaveResult[] perform(SObject[] sObjects) throws ConnectionException;

    /**
     * @return save result from the update
     */
    public SaveResult[] getResults() {
        return results;
    }


    /**
     * See if Rerrange is needed.
     * @param saveResults
     * @param sobjects
     * @param <S>
     * @param <T>
     * @return true if saveResults array and sobjects array have matching Ids in the order of both arrays
     */
    public static <S extends SaveResult, T extends SObject> boolean isRearrangeNeeded(S[] saveResults, T[] sobjects) {
        if (saveResults.length != sobjects.length) throw new IllegalArgumentException("argument size not the same");

        for (int i = 0; i < saveResults.length; i++) {
            if (!SfIDEqual(saveResults[i].getId(),sobjects[i].getId())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Rearrange sobjects in the order as saveResults based on IDs
     * @param saveResults
     * @param sobjects
     * @param <S> cannot be null
     * @param <T> cannot be null
     * @return
     */
    public static <S extends SaveResult, T extends SObject> T[] rearrangeOnSaveResults(S[] saveResults, T[] sobjects) {
        if (saveResults.length != sobjects.length) throw new IllegalArgumentException("Length for saveResults and sobjects must be the same ");
        if (!isRearrangeNeeded(saveResults, sobjects)) {
            return sobjects;
        }

        ArrayList<T> returnList = new ArrayList<>();
        Hashtable<String,T> sobjHashTable = new Hashtable<>();
        Arrays.stream(sobjects).forEach(o -> sobjHashTable.put(o.getId(), o));
        Arrays.stream(saveResults).forEach(r -> {
            if (sobjHashTable.containsKey(r.getId())) {
                returnList.add(sobjHashTable.get(r.getId()));
            }
            else {
                throw new SfDataUpdateException("Something wrong with Salesforce. Ids for updating object and result do match.");
            }
        });

        return returnList.toArray(sobjects);
    }
}
