package oe.sf;

import com.sforce.soap.enterprise.SaveResult;
import com.sforce.soap.enterprise.sobject.SObject;
import com.sforce.ws.ConnectionException;


public class Updater<T extends SObject>  extends Upserter<T>{

    /**
     * contructor for preparing array to be updated in Salesforce
     * @param sObjects to be updated in Salesforce; cannot be null
     */
    public Updater(T[] sObjects) {
       super(sObjects);
    }

    @Override
    public SaveResult[] perform(SObject[] sObjects) throws ConnectionException {
        return Conn.getInstance().update(sObjects);
    }

    /**
     * Rearrange the objects that were updated in Salesforce to match the order of SaveResult[]
     * @return rearraged updated sobjects
     */
    public T[] getRearrangedSobjs() {
        upserterSObjs = rearrangeOnSaveResults(results, upserterSObjs);
        return upserterSObjs;
    }
}
